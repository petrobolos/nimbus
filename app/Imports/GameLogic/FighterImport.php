<?php

namespace App\Imports\GameLogic;

use App\Imports\BaseImport;
use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\Race;
use App\Rules\GameLogic\ExceedsMinimumStatRule;
use App\Rules\GameLogic\SubceedsMaximumStatRule;

final class FighterImport extends BaseImport
{
    /**
     * Generates fighters based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\GameLogic\Fighter
     */
    public function model(array $row): ?Fighter
    {
        return new Fighter([
            'name' => $row['name'],
            'race_id' => Race::query()->firstWhere('name', $row['race'])?->id,
            'last_form_id' => ! empty($row['last_form'])
                ? Fighter::query()->firstWhere('name', $row['last_form'])?->id
                : null,
            'base_hp' => $row['hp'],
            'base_sp' => $row['sp'],
            'base_attack' => $row['attack'],
            'base_defense' => $row['defense'],
            'base_speed' => $row['speed'],
            'base_special' => $row['special'],
            'base_spirit' => $row['spirit'],
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
                'unique:fighters',
                'string',
                'min:1',
                'max:50',
            ],

            'race' => [
                'required',
                'exists:races,name',
                'string',
            ],

            'last_form' => [
                'nullable',
                'exists:fighters,name',
                'string',
            ],

            'hp' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'sp' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'attack' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'defense' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'speed' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'special' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'spirit' => [
                'required',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
