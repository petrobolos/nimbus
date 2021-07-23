<?php

namespace App\Imports\Sheets;

use App\Imports\Import;
use App\Models\Ability;

class AbilitiesData extends Import
{
    /**
     * Generates abilities based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\Ability
     */
    public function model(array $row): ?Ability
    {
        return new Ability([
            'name' => $row['name'],
            'code' => mb_strtolower($row['code']),
            'cost' => $row['cost'],
            'type' => Ability::TYPES[mb_strtolower($row['type'])] ?? Ability::TYPE_SPECIAL,
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
            'cost' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
