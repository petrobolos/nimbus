<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 * Class Import
 *
 * @package App\Imports
 */
abstract class Import implements SkipsEmptyRows, ToModel, WithHeadingRow, WithProgressBar, WithUpserts, WithValidation
{
    use Importable;

    public const HEADING_ROW = 2;

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
