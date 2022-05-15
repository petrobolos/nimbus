<?php

namespace App\Enums\GameLogic\Abilities;

use Petrobolos\FixedArray\FixedArray;
use SplFixedArray;

enum AbilityType: int
{
    case SKIP = -1;
    case BLOCK = 0;
    case PHYSICAL = 1;
    case SPECIAL = 2;
    case RECOVERY = 3;

    /**
     * Return the types of ability.
     *
     * @return \SplFixedArray
     */
    public static function types(): SplFixedArray
    {
        return FixedArray::fromArray(self::cases());
    }

    /**
     * Return the default ability type.
     *
     * @return int
     */
    public static function default(): int
    {
        return self::SKIP->value;
    }
}
