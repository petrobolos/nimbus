<?php

namespace App\Services;

use App\Classes\Game\Action;
use App\Models\Game;

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
     * @return \App\Models\Game
     */
    public function apply(Game $game, Action $action): Game
    {
        // Update the game's state.
        $game->state->addToState($action);
        $game->state->switchCurrentPlayer();

        return $game;
    }
}
