<?php

use App\Enums\Difficulty;

return [
    'session_key' => 'demo_last_played',
    'completion_key' => 'demo_complete',

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
