<?php

namespace App\Imports;

use App\Models\Fighter;
use App\Models\Race;

/**
 * Class FightersImport
 *
 * @package App\Imports
 */
class FightersImport extends Import
{
    /**
     * Generates fighters based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\Fighter
     */
    public function model(array $row): ?Fighter
    {
        return new Fighter([
            'name' => $row['name'],
            'code' => mb_strtolower($row['code']),
            'race_id' => Race::where('code', mb_strtolower($row['race_code']))->first()?->id,
            'is_boss' => $row['is_boss'],
            'last_form_id' => $row['last_form']
                ? Fighter::where('code', mb_strtolower($row['last_form']))->first()?->id
                : null,
            'hp' => $row['hp'],
            'sp' => $row['sp'],
            'attack' => $row['attack'],
            'defense' => $row['defense'],
            'speed' => $row['speed'],
            'special' => $row['special'],
            'spirit' => $row['spirit'],
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
            'race_code' => ['required', 'string'],
            'is_boss' => ['required', 'boolean'],
            'last_form' => ['nullable', 'string'],
            'hp' => ['required', 'integer'],
            'sp' => ['required', 'integer'],
            'attack' => ['required', 'integer'],
            'defense' => ['required', 'integer'],
            'speed' => ['required', 'integer'],
            'special' => ['required', 'integer'],
            'spirit' => ['required', 'integer'],
            'description' => ['nullable', 'string']
        ];
    }

    /**
     * Return custom validation for row columns.
     *
     * @return string[]
     */
    public function customValidationMessages(): array
    {
        return [
            'race_code.in' => 'Race is not in the recognized list.',
        ];
    }
}
