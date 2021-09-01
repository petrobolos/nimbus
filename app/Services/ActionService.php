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

        if ($ability->cost > $attacker->current_sp) {
            throw new Exception('You don\'t have enough SP for this move...');
        }

        // Abilities that are free have base damage set to 1. We don't want any divisions by zero!
        $cost = $ability->cost ?: 1;

        // If the ability is a recovery move, we use a different logic pathway.
        if ($ability->type === Ability::TYPE_RECOVERY) {
            // Calculate whether the ability restores HP or SP
        } else {
            // Attacks that are physical use their attack as their multiplier, and special attacks use the special stat.
            $multiplier = match ($ability->type) {
                Ability::TYPE_PHYSICAL => $attacker->attack,
                Ability::TYPE_SPECIAL => $attacker->special,
            };

            // Calculate a critical hit chance for the attack, which will double its damage.
            $criticalChance = ceil(7 + ($attacker->speed / 7));
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

            // As we don't want to inadvertently restore health, the minimum damage that can be inflicted is zero.
            if ($finalCalc < 0) {
                $finalCalc = 0;
            }
        }

        $attacker->current_sp -= $cost;

        // Float weirdness might cause us to somehow overspend, so let's rectify that here if needed.
        if ($attacker->current_sp < 0) {
            $attacker->current_sp = 0;
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
