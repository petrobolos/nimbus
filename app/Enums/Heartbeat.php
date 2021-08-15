<?php

namespace App\Enums;

/**
 * Class Heartbeat.
 *
 * @package App\Enums
 */
class Heartbeat
{
    public const DEMO = 'heartbeat_demo';

    public const SINGLE_PLAYER = 'heartbeat_sp';

    public const UNRANKED = 'heartbeat_unranked';

    public const RANKED = 'heartbeat_ranked';

    public const CUSTOM = 'heartbeat_custom';

    public const HEARTBEATS = [
        self::DEMO,
        self::SINGLE_PLAYER,
        self::UNRANKED,
        self::RANKED,
        self::CUSTOM,
    ];
}
