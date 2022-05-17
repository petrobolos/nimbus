<?php

namespace App\Enums\GameLogic;

enum PartyMember: int
{
    case FIRST = 1;
    case SECOND = 2;
    case THIRD = 3;

    /**
     * Return the value of the default party member.
     *
     * @return int
     */
    public static function default(): int
    {
        return self::FIRST->value;
    }
}
