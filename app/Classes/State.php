<?php

namespace App\Classes;

use App\Models\Player;
use Tailflow\DataTransferObjects\CastableDataTransferObject;

/**
 * Class State
 *
 * @package App\Classes
 */
class State extends CastableDataTransferObject
{
    public array $history;
    public int $currentPlayer;

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
     * Get the first turn from the state.
     *
     * @return array
     */
    public function getFirstTurn(): array
    {
        return collect($this->history['state'])->first() ?? [];
    }

    /**
     * Get the latest turn from the state.
     *
     * @return array
     */
    public function getLastTurn(): array
    {
        return collect($this->history['state'])->last() ?? [];
    }

    /**
     * Determines whether the game has any turns saved.
     *
     * @return bool
     */
    public function hasGameStarted(): bool
    {
        return !empty($this->history['state']);
    }

    /**
     * Provides a count of the number of elapsed turns.
     *
     * @return int
     */
    public function turns(): int
    {
        if ($this->hasGameStarted()) {
            return count($this->history['state']);
        }

        return 0;
    }
}
