<?php

namespace App\Enums;

enum GameMode: int
{
    case DEMO = 0;
    case AGAINST_AI = 1;
    case UNRANKED_MULTIPLAYER = 2;
    case RANKED_MULTIPLAYER = 3;

    /**
     * Return the default game mode.
     *
     * @return int
     */
    public static function default(): int
    {
        return self::DEMO->value;
    }

    /**
     * Pretty-print the game mode.
     *
     * @return string
     */
    public function pretty(): string
    {
        return match ($this) {
            self::DEMO => 'Demo',
            self::AGAINST_AI => 'Single Player',
            self::UNRANKED_MULTIPLAYER => 'Casual Multiplayer',
            self::RANKED_MULTIPLAYER => 'Ranked Multiplayer',
        };
    }
}
