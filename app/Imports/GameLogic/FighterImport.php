<?php

namespace App\Imports\GameLogic;

use App\Imports\BaseImport;
use App\Models\GameLogic\Race;

final class RaceImport extends BaseImport
{
    /**
     * Generates races based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\GameLogic\Race
     */
    public function model(array $row): ?Race
    {
        return new Race([
            'name' => $row['name'],
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
            'name' => [
                'required',
                'unique:races',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
