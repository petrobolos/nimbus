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
}
