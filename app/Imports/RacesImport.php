<?php

namespace App\Imports;

use App\Models\Race;

/**
 * Class RacesImport
 *
 * @package App\Imports
 */
class RacesImport extends Import
{
    /**
     * Generates races based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\Race
     */
    public function model(array $row): ?Race
    {
        return new Race([
            'name' => $row['name'],
            'code' => mb_strtolower($row['code']),
            'description' => $row['description'],
        ]);
    }

    /**
     * Validate that the data in each column is correct.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
