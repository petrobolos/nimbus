<?php

namespace App\Observers;

use App\Classes\Game\State;
use App\Models\Game;

/**
 * Class GameObserver.
 *
 * @package App\Observers
 */
class GameObserver
{
    /**
     * Handle the game "created" event.
     *
     * @param \App\Models\Game $game
     * @return void
     */
    public function created(Game $game): void
    {
        $game->state = State::initialize();
        $game->save();
    }

    /**
     * Handle the game "updated" event.
     *
     * @param \App\Models\Game $game
     * @return void
     */
    public function updated(Game $game): void
    {
        // Do nothing for now.
    }

    /**
     * Handle the game "deleted" event.
     *
     * @param \App\Models\Game $game
     * @return void
     */
    public function deleted(Game $game): void
    {
        // Do nothing for now.
    }

    /**
     * Handle the game "restored" event.
     *
     * @param \App\Models\Game $game
     * @return void
     */
    public function restored(Game $game): void
    {
        // Do nothing for now.
    }

    /**
     * Handle the game "force deleted" event.
     *
     * @param \App\Models\Game $game
     * @return void
     */
    public function forceDeleted(Game $game): void
    {
        // Do nothing for now.
    }
}
