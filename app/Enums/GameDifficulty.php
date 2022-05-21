<?php

namespace App\Enums;

enum GameDifficulty: string
{
    case EASY = 'easy';
    case NORMAL = 'normal';
    case HARD = 'hard';

    /**
     * Return the default game status.
     *
     * @return int
     */
    public static function default(): int
    {
        return self::EASY->value;
    }
}
