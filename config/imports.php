<?php

use App\Imports\GameLogic\AbilityImport;
use App\Imports\GameLogic\FighterImport;
use App\Imports\GameLogic\RaceImport;
use Maatwebsite\Excel\Excel;

return [
    /*
    |--------------------------------------------------------------------------
    | Import spreadsheet locations
    |--------------------------------------------------------------------------
    |
    | The location of a class' given spreadsheet import.
    |
    */
    'imports' => [
        [
            'name' => 'Races',
            'importer' => RaceImport::class,
            'file' => database_path('/sheets/Races.ods'),
            'type' => Excel::ODS,
        ],
        [
            'name' => 'Fighters',
            'importer' => FighterImport::class,
            'file' => database_path('/sheets/Fighters.ods'),
            'type' => Excel::ODS,
        ],
        [
            'name' => 'Abilities / Effects',
            'importer' => AbilityImport::class,
            'file' => database_path('/sheets/Abilities.ods'),
            'type' => Excel::ODS,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Acceptable Boolean values
    |--------------------------------------------------------------------------
    |
    | Values that will be accepted as a valid Boolean truthy value. Type/case insensitive.
    |
    */
    'acceptable_boolean_values' => [
        'yes',
        true,
        'x',
        1,
    ],
];
