<?php

namespace App\Imports;

use App\Models\Fighter;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithUpserts;

class FightersImporter implements ToModel, WithHeadingRow, WithProgressBar, WithUpserts
{
    use Importable;

    public const HEADING_ROW = 2;

    /**
     * Generates fighters based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\Fighter
     */
    public function model(array $row): ?Fighter
    {
        // TODO: Finish the rest of the importer.
        return null;
    }

    /**
     * Returns the property that determines whether to insert or update a model.
     *
     * @return string
     */
    public function uniqueBy(): string
    {
        return 'code';
    }

    /**
     * Returns the heading row used for the spreadsheet.
     *
     * @return int
     */
    public function headingRow(): int
    {
        return self::HEADING_ROW;
    }
}
