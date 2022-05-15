<?php

namespace App\Enums\GameLogic\Abilities;

use Petrobolos\FixedArray\FixedArray;
use SplFixedArray;

enum AbilityEffect: int
{
    case RECOVERY_HP = 0;
    case RECOVERY_SP = 1;
    case PARALYSIS = 2;
    case OHKO_CHANCE = 3;
    case ENHANCED_CRIT_CHANCE = 4;
    case DRAINS_HP = 5;
    case PURE = 6;

    /**
     * Return the effects an ability can inflict.
     *
     * @return \SplFixedArray
     */
    public static function effects(): SplFixedArray
    {
        return FixedArray::fromArray(self::cases());
    }
}
