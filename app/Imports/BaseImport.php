<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

abstract class BaseImport implements SkipsEmptyRows, ToModel, WithHeadingRow, WithProgressBar, WithUpserts, WithValidation
{
    use Importable;

    /**
     * Returns the heading row of the import spreadsheets.
     *
     * @var int
     */
    public const HEADING_ROW = 3;

    /**
     * Return the property that determines whether to insert or update a model.
     *
     * @return string
     */
    public function uniqueBy(): string
    {
        return 'name';
    }

    /**
     * Returning the heading row used for the spreadsheet.
     *
     * @return int
     */
    public function headingRow(): int
    {
        return self::HEADING_ROW;
    }
}
