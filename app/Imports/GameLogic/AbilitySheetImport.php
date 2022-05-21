<?php

namespace App\Imports\GameLogic;

use App\Enums\GameLogic\Abilities\AbilityType;
use App\Imports\BaseImport;
use App\Models\GameLogic\Ability;
use App\Rules\GameLogic\ExceedsMinimumCostRule;
use App\Rules\GameLogic\SubceedsMaximumCostRule;
use App\Rules\GameLogic\ValidAbilityTypeRule;

final class AbilitySheetImport extends BaseImport
{
    /**
     * Generates abilities based on each row of the import sheet.
     *
     * @param array $row
     * @return null|\App\Models\GameLogic\Ability
     */
    public function model(array $row): ?Ability
    {
        return new Ability([
            'name' => $row['name'],
            'cost' => $row['cost'],
            'type' => AbilityType::fromPretty($row['type']),
            'description' => $row['description'],
            'is_universal' => false,
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
                'string',
                'unique:abilities',
                'min:1',
                'max:50',
            ],

            'cost' => [
                'required',
                'integer',
                new ExceedsMinimumCostRule(),
                new SubceedsMaximumCostRule(),
            ],

            'type' => [
                'required',
                'string',
                new ValidAbilityTypeRule(),
            ],

            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
