<?php

namespace App\Services;

use App\Classes\Game\Action;
use App\Exceptions\Game\FighterIsDefeatedException;
use App\Exceptions\Game\InsufficientResourceException;
use App\Exceptions\Game\InvalidFighterSwitchException;
use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Game;
use App\Models\Perk;
use App\Models\Player;

/**
 * Class ActionService
 *
 * @package App\Services
 */
class ActionService
{
    /**
     * Apply an action to the game.
     *
     * @param \App\Models\Game $game
     * @param \App\Classes\Game\Action $action
     * @throws \App\Exceptions\Game\FighterIsDefeatedException
     * @throws \App\Exceptions\Game\InsufficientResourceException
     * @throws \App\Exceptions\Game\InvalidFighterSwitchException
     * @return \App\Models\Game
     */
    public function apply(Game $game, Action $action): Game
    {
        switch ($action->type) {
            case Action::TYPE_ABILITY:
                $this->attack($game->currentPlayer->fighter, $game->currentOpponent->fighter, $action->model);
                break;

            case Action::TYPE_SWITCH:
                $this->switchFighter($game->currentPlayer, $action->model);
                break;

            case Action::TYPE_SKIP:
                $this->skipTurn($game->currentPlayer->fighter, $action->model);
                break;
        }

        // Update the game's state.
        $game->state->addToState($action);

        // Check if the opponent has been knocked out, and in turn, check if the game is over.
        $game->state->switchCurrentPlayer();

        $game->save();

        return $game;
    }

    /**
     * Launch a given attack against a defending fighter.
     *
     * @param \App\Models\Fighter $attacker
     * @param \App\Models\Fighter $defender
     * @param \App\Models\Ability $ability
     * @throws \App\Exceptions\Game\InsufficientResourceException|\Exception
     * @return void
     */
    private function attack(Fighter $attacker, Fighter $defender, Ability $ability): void
    {
        if ($ability->isSkip()) {
            $this->skipTurn($attacker, $ability->s);

            return;
        }

        if (! $attacker->hasEnoughResource($ability)) {
            throw new InsufficientResourceException();
        }

        switch ($ability->type) {
            case Ability::TYPE_PHYSICAL:
                $this->damageCalculator($attacker, $defender, $ability, $attacker->attack);
                break;

            case Ability::TYPE_SPECIAL:
                $this->damageCalculator($attacker, $defender, $ability, $attacker->special);
                break;

            case Ability::TYPE_RECOVERY:
                $this->recover($attacker, $ability);
                break;
        }

        $this->deductCosts($attacker, $ability);
    }

    /**
     * Calculate damage between fighters with an ability.
     *
     * @param \App\Models\Fighter $attacker
     * @param \App\Models\Fighter $defender
     * @param \App\Models\Ability $ability
     * @param int $multiplier
     * @throws \Exception
     * @return void
     */
    private function damageCalculator(Fighter $attacker, Fighter $defender, Ability $ability, int $multiplier): void
    {
        if (! $defender->isImmuneToAbility($attacker->race, $ability)) {
            $luck = config('battle.calculation_stats.luck');
            $easyChance = config('battle.calculation_stats.easy_chance');
            $hardChance = config('battle.calculation_stats.hard_chance');

            $attack = $this->calculateOffense($attacker, $defender, $ability, $multiplier);
            $defense = $this->calculateDefense($attacker, $defender);

            // Calculate the final amount to be removed.
            $result = $attack - $defense;
            $result = $result < 0 ? 0 : $result;

            if (is_numeric($ability[Ability::EFFECT_OHKO])) {
                $ohkoChance = floor($luck + ($ability->effects[Ability::EFFECT_OHKO]) / $luck);
                $ohkoRange = $attacker->isBoss() ? $easyChance : $hardChance;

                if ($ohkoChance > random_int(0, $ohkoRange)) {
                    $result += $defender->current_hp;
                }
            }

            if (is_numeric($ability[Ability::EFFECT_PARALYSIS] && $result >= $defender->current_hp)) {
                $paralysisChance = ceil($ability->effects[Ability::EFFECT_PARALYSIS] / 2);

                if ($paralysisChance >= random_int(0, $easyChance)) {
                    $defender->is_paralyzed = true;
                }
            }

            $defender->current_hp -= $result;
            $defender->current_hp = $defender->current_hp < 0 ? 0 : $defender->current_hp;

            $defender->save();
        }
    }

    /**
     * Calculate the offense of the calculation.
     *
     * @param \App\Models\Fighter $attacker
     * @param \App\Models\Fighter $defender
     * @param \App\Models\Ability $ability
     * @param int $multiplier
     * @throws \Exception
     * @return float
     */
    private function calculateOffense(Fighter $attacker, Fighter $defender, Ability $ability, int $multiplier): float
    {
        $baseDamage = config('battle.calculation_stats.damage');
        $baseLuck = config('battle.calculation_stats.luck');
        $luckChance = config('battle.calculation_stats.easy_chance');
        $statBonus = config('battle.calculation_stats.multiplier');

        // Calculate race offense.
        $superEffectiveAttack = $attacker->compareRace($defender->race, Perk::TYPE_SUPER_EFFECTIVE) ? 1.5 : 1;
        $ineffectiveAttack = $attacker->compareRace($defender->race, Perk::TYPE_INEFFECTIVE) ? 0.5 : 1;

        // Calculate whether this will be a critical hit.
        $abilityBonusCriticalChance = is_numeric($ability->effects[Ability::EFFECT_CRIT_CHANCE]) ? Ability::EFFECT_CRIT_CHANCE / 2 : 0;
        $critMultiplier = ceil($baseLuck + ($attacker->speed / $baseLuck) + $abilityBonusCriticalChance) > random_int(0, $luckChance) ? 2 : 1;

        return floor(((($ability->cost ?: $baseDamage) + ($multiplier * $statBonus) * $superEffectiveAttack) * $ineffectiveAttack) * $critMultiplier);
    }

    /**
     * Calculate the defense of the calculation.
     *
     * @param \App\Models\Fighter $attacker
     * @param \App\Models\Fighter $defender
     * @throws \Exception
     * @return float
     */
    private function calculateDefense(Fighter $attacker, Fighter $defender): float
    {
        $baseLuck = config('battle.calculation_stats.luck');
        $baseChance = config('battle.calculation_stats.hard_chance');
        $bossArmour = $defender->isBoss() ? config('battle.boss_perks.armour') : 0;

        $isResistant = $defender->compareRace($attacker->race, Perk::TYPE_RESISTANCE) ? 1.5 : 1;
        $isWeak = $defender->compareRace($attacker->race, Perk::TYPE_WEAKNESS) ? 0.5 : 1;
        $defense = ceil($baseLuck + ($defender->spirit / $baseLuck)) >= random_int(0, $baseChance) ? 4 : 2;

        return floor(((($defense + $bossArmour) * $isResistant) * $isWeak));
    }

    /**
     * Deduct costs accrued from the use of the ability, typically SP.
     *
     * @param \App\Models\Fighter $attacker
     * @param \App\Models\Ability $ability
     * @return void
     */
    private function deductCosts(Fighter $attacker, Ability $ability): void
    {
        if ($ability->effects[Ability::EFFECT_HP_DRAIN]) {
            $attacker->current_hp -= $ability->cost;
            $attacker->current_hp = $attacker->current_hp < 0 ? 0 : $attacker->current_hp;
        } else {
            $attacker->current_sp -= $ability->cost;
            $attacker->current_sp = $attacker->current_sp < 0 ? 0 : $attacker->current_sp;
        }

        $attacker->save();
    }

    /**
     * Recover resources when the ability is of that type.
     *
     * @param \App\Models\Fighter $healer
     * @param \App\Models\Ability $recoveryAbility
     * @return void
     */
    private function recover(Fighter $healer, Ability $recoveryAbility): void
    {
        $healer->current_hp += $recoveryAbility->effects[Ability::EFFECT_RECOVER_HP];
        $healer->current_sp += $recoveryAbility->effects[Ability::EFFECT_RECOVER_SP];

        $healer->save();
    }

    /**
     * Switch fighter with the selected character.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Fighter $replacementFighter
     * @throws \App\Exceptions\Game\FighterIsDefeatedException
     * @throws \App\Exceptions\Game\InvalidFighterSwitchException
     * @return void
     */
    private function switchFighter(Player $player, Fighter $replacementFighter): void
    {
        $fighters = array_filter([
            $player->firstFighter?->id,
            $player->secondFighter?->id,
            $player->thirdFighter?->id,
        ]);
        $fighters = array_combine($fighters, $fighters);

        if (! isset($fighters[$replacementFighter->id])) {
            throw new InvalidFighterSwitchException();
        }

        if ($fighters[$replacementFighter->id]->current_hp <= 0) {
            throw new FighterIsDefeatedException();
        }

        $player->update(['current_fighter' => $replacementFighter->id]);
    }

    /**
     * Skips a turn. Cures paralysis.
     *
     * @param \App\Models\Fighter $skipper
     * @return void
     */
    private function skipTurn(Fighter $skipper): void
    {
        if ($skipper->is_paralyzed) {
            $skipper->update(['is_paralyzed' => false]);
        }
    }
}
