<?php

namespace App\Services;

use App\Classes\Game\Action;
use App\Exceptions\Game\InvalidActionException;
use App\Models\Ability;
use App\Models\Game;
use App\Models\Player;
use Exception;

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
     * @throws \App\Exceptions\Game\InvalidActionException
     * @return \App\Models\Game
     */
    public function apply(Game $game, Action $action): Game
    {
        // Pass into an act method where everything is tied together
        // But first determine what kind of act it is so that it can be passed to the appropriate method
        $game = match ($action->type) {
            Action::TYPE_ABILITY => $this->attack($game, $game->currentPlayer, $game->currentOpponent, $action->model),
            Action::TYPE_SWITCH => $this->switchFighter($game, $action),
            Action::TYPE_SKIP => $this->skipTurn($game),
        };

        // Update the game's state.
        $game->state->addToState($action);

        // Check if the opponent has been knocked out, and in turn, check if the game is over.
        $game->state->switchCurrentPlayer();

        $game->save();

        return $game;
    }

    /**
     * @param \App\Models\Game $game
     * @param \App\Models\Player $player
     * @param \App\Models\Player $opponent
     * @param \App\Models\Ability $ability
     * @throws \App\Exceptions\Game\InvalidActionException|\Exception
     * @return \App\Models\Game
     */
    private function attack(Game $game, Player $player, Player $opponent, Ability $ability): Game
    {
        if ($ability->isSkip()) {
            throw new InvalidActionException('Skip ability has been inadvertently passed to the attack method.');
        }

        // For convenience, gather the current attacker and defender on the field.
        $attacker = $player->fighter;
        $defender = $opponent->fighter;

        if ($ability->cost > $attacker->current_sp || ($ability->effects[Ability::EFFECT_HP_DRAIN] && ($attacker->current_hp - $ability->cost > 0) && ($ability->cost > $attacker->current_hp))) {
            throw new Exception('You don\'t have enough SP (or HP) for this move...');
        }

        // Abilities that are free have base damage set to 1. We don't want any divisions by zero!
        $cost = $ability->cost ?: 1;

        if ($ability->type === Ability::TYPE_RECOVERY) {
            $attacker->current_hp += $ability->effects[Ability::EFFECT_RECOVER_HP];
            $attacker->current_sp += $ability->effects[Ability::EFFECT_RECOVER_SP];
        } else {
            // Attacks that are physical use their attack as their multiplier, and special attacks use the special stat.
            $multiplier = match ($ability->type) {
                Ability::TYPE_PHYSICAL => $attacker->attack,
                Ability::TYPE_SPECIAL => $attacker->special,
            };

            // Calculate a critical hit chance for the attack, which will double its damage.
            // If the ability has an elevated crit chance, this is added to the calculation.
            $elevatedCritChance = is_numeric($ability->effects[Ability::EFFECT_CRIT_CHANCE])
                ? Ability::EFFECT_CRIT_CHANCE / 2
                : 0;

            $criticalChance = ceil(7 + ($attacker->speed / 7) + $elevatedCritChance);
            $isCriticalHit = $criticalChance >= random_int(0, 100);

            // Calculate a critical hit chance for the defense, which will greatly negate incoming damage.
            $criticalDefenseChance = ceil(7 + ($defender->spirit / 7));
            $isPerfectDefend = $criticalDefenseChance >= random_int(0, 255);

            // This is the base damage that is to be outputted prior to factoring in critical hits or defense.
            $initialDamageCalculation = $cost + ($multiplier * 0.9);

            // If the enemy is a boss, we add an extra 10 to the enemy defense.
            $bossArmour = $defender->isBoss() ? 10 : 0;

            // Determine final damage and defense quantities before the final calculation, depending on critical hits.
            $attackCalculation = $isCriticalHit ? $initialDamageCalculation * 2 : $initialDamageCalculation;
            $defenseCalculation = $bossArmour + ($isPerfectDefend ? ($defender->defense / 2) : ($defender->defense / 4));

            $finalCalc = $attackCalculation - $defenseCalculation;

            // Calculate OHKO chances if this move uses them.
            if (is_numeric($ability->effects[Ability::EFFECT_OHKO])) {
                $ohkoChance = floor(7 + ($ability->effects[Ability::EFFECT_OHKO] / 7));

                // Bosses have a significantly higher chance of scoring an OHKO.
                $bossOhkoChance = $attacker->isBoss() ? 100 : 255;
                $isOhko = $ohkoChance >= random_int(0, $bossOhkoChance);

                if ($isOhko) {
                    $finalCalc += $defender->current_hp;
                }
            }

            // As we don't want to inadvertently restore health, the minimum damage that can be inflicted is zero.
            if ($finalCalc < 0) {
                $finalCalc = 0;
            }

            // Do the calculation!
            $defender->current_hp -= $finalCalc;

            // If they're still breathing, do paralysis checks.
            if ($defender->current_hp > 0 && is_numeric($ability->effects[Ability::EFFECT_PARALYSIS])) {
                $paralysisChance = ceil($ability->effects[Ability::EFFECT_PARALYSIS] / 2);
                $paralysisCheck = $paralysisChance >= random_int(0, 100);

                if ($paralysisCheck) {
                    $defender->is_paralyzed = true;
                }
            }
        }

        // Most fighters will use SP to pay for abilities, but abilities with HP drain will cost HP instead.
        if ($ability->effects[Ability::EFFECT_HP_DRAIN]) {
            $attacker->current_hp -= $cost;
        } else {
            $attacker->current_sp -= $cost;
        }

        // Normalise values to 0 if they have gone negative. (Except for attacker HP, which shouldn't go zero at all.)
        if ($attacker->current_hp < 0) {
            $attacker->current_hp = 1;
        }

        if ($attacker->current_sp < 0) {
            $attacker->current_sp = 0;
        }

        if ($defender->current_hp < 0) {
            $defender->current_hp = 0;
        }

        $attacker->save();
        $defender->save();

        return $game;
    }

    private function switchFighter(Game $game, Action $replacement)
    {
        return $game;
    }

    private function skipTurn(Game $game)
    {
        return $game;
    }
}
