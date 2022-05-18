<?php

use App\Enums\GameLogic\Abilities\AbilityType;

return [
    /*
    |--------------------------------------------------------------------------
    | Universal abilities
    |--------------------------------------------------------------------------
    |
    | Any universal abilities that need to be made available to all playable fighters.
    |
    */
    'universal_abilities' => [
        [
            'name' => 'Skip',
            'cost' => 0,
            'type' => AbilityType::SKIP,
            'description' => 'Skips your turn without doing anything. Cures paralysis.',
        ],
        [
            'name' => 'Attack',
            'cost' => 0,
            'type' => AbilityType::PHYSICAL,
            'description' => "Standard physical attack. It doesn't cost anything.",
        ],
        [
            'name' => 'Defend',
            'cost' => 0,
            'type' => AbilityType::BLOCK,
            'description' => "Adopts a defensive pose to reduce incoming damage. It doesn't cost anything.",
        ],
        [
            'name' => 'Heal',
            'cost' => 20,
            'type' => AbilityType::RECOVERY,
            'description' => 'Restores HP and heals from injuries. Costs a large amount of SP.',
        ],
        [
            'name' => 'Power Up',
            'cost' => 0,
            'type' => AbilityType::RECOVERY,
            'description' => 'Restores SP but costs a turn.',
        ],
        [
            'name' => 'Ki Blast',
            'cost' => 2,
            'type' => AbilityType::SPECIAL,
            'description' => 'A basic energy blast.',
        ],
        [
            'name' => 'Ki Wave',
            'cost' => 4,
            'type' => AbilityType::SPECIAL,
            'description' => 'An energy blast directed as a continuous beam of ki.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Artificial intelligence settings
    |--------------------------------------------------------------------------
    |
    | Any settings that directly affect the artificial intelligence engine are defined here.
    |
    */
    'ai' => [
        'difficulties' => [
            'easy',
            'medium',
            'difficult',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Webgame settings
    |--------------------------------------------------------------------------
    |
    | Any settings that directly affect the webgame experience or interface are defined here.
    |
    */
    'webgame' => [
        'default_player_name' => 'Guest',
        'default_cpu_name' => 'CPU',
    ],
];
