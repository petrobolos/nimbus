<?php

use App\Enums\Difficulty;

return [
    'session_key' => 'demo_game',
    'difficulty_key' => 'demo_last_played',
    'completion_key' => 'demo_complete',

    'player_roster' => [
        'kid_goku',
        'krillin',
        'tien',
    ],

    'roster' => [
        Difficulty::HARD => [
            'kid_goku',
            'piccolo',
            'frieza',
        ],
        Difficulty::MEDIUM => [
            'goku',
            'piccolo',
            null,
        ],
        Difficulty::EASY => [
            'kid_goku',
            null,
            null,
        ],
    ],
];
