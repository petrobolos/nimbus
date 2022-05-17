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

    /**
     * Return an array of the game modes that are single player.
     *
     * @return \App\Enums\GameMode[]
     */
    public static function singlePlayerModes(): array
    {
        return [
            self::DEMO,
            self::AGAINST_AI,
        ];
    }

    /**
     * Return an array of the game modes that are multiplayer.
     *
     * @return \App\Enums\GameMode[]
     */
    public static function multiplayerModes(): array
    {
        return [
            self::RANKED_MULTIPLAYER,
            self::UNRANKED_MULTIPLAYER,
        ];
    }

    /**
     * Pretty-print the game mode.
     *
     * @return string
     */
    public function pretty(): string
    {
        return match ($this) {
            self::DEMO => 'Demo',
            self::AGAINST_AI => 'Single Player',
            self::UNRANKED_MULTIPLAYER => 'Casual Multiplayer',
            self::RANKED_MULTIPLAYER => 'Ranked Multiplayer',
        };
    }
}
