<?php

namespace App\Enums\GameLogic\Perks;

use Petrobolos\FixedArray\FixedArray;
use SplFixedArray;

enum PerkType: int
{
    case WEAKNESS = 0;
    case RESISTANCE = 1;
    case SUPER_EFFECTIVE = 2;
    case INEFFECTIVE = 3;
    case PHYSICAL_IMMUNITY = 4;
    case SPECIAL_IMMUNITY = 5;

    /**
     * Return the various perk types.
     *
     * @return \SplFixedArray
     */
    public static function types(): SplFixedArray
    {
        return FixedArray::fromArray(self::cases());
    }
}
