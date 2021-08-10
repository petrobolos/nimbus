<?php

namespace App\Enums;

/**
 * Class Difficulty
 *
 * @package App\Enums
 */
class Difficulty
{
    public const EASY = 'easy';
    public const MEDIUM = 'medium';
    public const HARD = 'hard';

    public const DIFFICULTIES = [
        self::EASY,
        self::MEDIUM,
        self::HARD,
    ];
}
