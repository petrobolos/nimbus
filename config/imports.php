<?php

use App\Models\GameLogic\Ability;
use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\Race;

return [
    /*
    |--------------------------------------------------------------------------
    | Import spreadsheet locations
    |--------------------------------------------------------------------------
    |
    | The location of a class' given spreadsheet import.
    |
    */
    'files' => [
        Race::class => database_path('/sheets/Races.ods'),
        Fighter::class => database_path('/sheets/Fighters.ods'),
        Ability::class => database_path('/sheets/Abilities.ods'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Class import order
    |--------------------------------------------------------------------------
    |
    | The order in which data will be imported from spreadsheet.
    | This order is also used for seeder generation. Models that do not have a
    | corresponding importer file will be ignored.
    |
    */
    'import_order' => [
        Race::class,
        Fighter::class,
        Ability::class,
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
