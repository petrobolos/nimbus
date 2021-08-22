<?php

namespace App\Enums;

/**
 * Class GameType
 *
 * @package App\Enums
 */
class GameType
{
    public const DEMO = 'Demo';
    public const AGAINST_AI = 'Against AI';
    public const RANKED = 'Ranked Multiplayer';
    public const UNRANKED = 'Unranked Multiplayer';

    public const TYPES = [
        self::DEMO,
        self::AGAINST_AI,
        self::RANKED,
        self::UNRANKED,
    ];
}
