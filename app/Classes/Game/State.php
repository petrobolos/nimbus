<?php

namespace App\Classes\Game;

use App\Models\Game;
use App\Models\Player;
use Tailflow\DataTransferObjects\CastableDataTransferObject;

/**
 * Class State.
 *
 * @package App\Classes\Game
 */
class State extends CastableDataTransferObject
{
    public array $history = [];

    public int $currentPlayer = Game::PLAYER_FIRST;

    /**
     * Set the initial state.
     *
     * @return array
     */
    public static function initialize(): array
    {
        return [
            'history' => [],
            'currentPlayer' => Player::FIGHTER_FIRST,
        ];
    }

    /**
     * Add a new item of state to the history.
     *
     * @param \App\Classes\Game\Action $action
     * @return void
     */
    public function addToState(Action $action): void
    {
        $this->history[] = $action->toArray();
    }

    /**
     * Toggle the current player and return the number.
     *
     * @return int
     */
    public function switchCurrentPlayer(): int
    {
        $this->currentPlayer = $this->currentPlayer === Game::PLAYER_FIRST
            ? Game::PLAYER_SECOND
            : Game::PLAYER_FIRST;

        return $this->currentPlayer;
    }

    /**
     * Get the first turn from the state.
     *
     * @return array
     */
    public function getFirstTurn(): array
    {
        return collect($this->history)->first() ?? [];
    }

    /**
     * Get the latest turn from the state.
     *
     * @return array
     */
    public function getLastTurn(): array
    {
        return collect($this->history)->last() ?? [];
    }

    /**
     * Determines whether the game has any turns saved.
     *
     * @return bool
     */
    public function hasGameStarted(): bool
    {
        return ! empty($this->history);
    }

    /**
     * Provides a count of the number of elapsed turns.
     *
     * @return int
     */
    public function turns(): int
    {
        if ($this->hasGameStarted()) {
            return count($this->history);
        }

        return 0;
    }

    /**
     * Compile the state array into a series of actions and players.
     *
     * @return array
     */
    public function compile(): array
    {
        return [
            'currentPlayer' => $this->currentPlayer,
            'history' => Action::convert($this->history),
        ];
    }
}
