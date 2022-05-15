<?php

namespace App\Enums;

enum GameStatus: int
{
    case INITIALIZED = 0;
    case IN_PROGRESS = 1;
    case CONCLUDED = 2;
    case ABANDONED = 3;

    /**
     * Return the default game status.
     *
     * @return int
     */
    public static function default(): int
    {
        return self::INITIALIZED->value;
    }
}
