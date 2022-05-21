<?php

namespace App\Imports\GameLogic;

use App\Imports\BaseImport;
use App\Models\GameLogic\Fighter;
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
                'required',
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
