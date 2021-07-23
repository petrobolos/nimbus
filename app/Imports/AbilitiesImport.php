<?php

namespace App\Imports;

use App\Imports\Sheets\AbilitiesData;
use App\Imports\Sheets\AbilitiesPivot;
use App\Models\Ability;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Class AbilitiesImport
 *
 * @package App\Imports
 */
class AbilitiesImport implements WithMultipleSheets
{
    use Importable;

    /**
     * Process each sheet of the spreadsheet.
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            Ability::IMPORT_SHEET_DATA => new AbilitiesData(),
            Ability::IMPORT_SHEET_PIVOT => new AbilitiesPivot(),
        ];
    }
}
