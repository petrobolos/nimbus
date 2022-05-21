<?php

namespace App\Imports\GameLogic;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

final class AbilityImport implements WithMultipleSheets
{
    use Importable;

    /**
     * Process each sheet of the spreadsheet as its own import.
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            'Abilities' => new AbilitySheetImport(),
            'Effects' => new EffectSheetImport(),
            'Assignment' => '',
        ];
    }
}
