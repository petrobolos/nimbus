<?php

namespace App\Imports\GameLogic;

use App\Enums\GameLogic\Abilities\AbilityEffect;
use App\Models\GameLogic\Ability;
use App\Rules\GameLogic\ExceedsMinimumStatRule;
use App\Rules\GameLogic\SubceedsMaximumStatRule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use RuntimeException;

final class EffectSheetImport implements ToCollection, WithCalculatedFormulas, WithHeadingRow, WithProgressBar, WithValidation
{
    use Importable;

    /**
     * Returns the heading row of the import spreadsheets.
     *
     * @var int
     */
    public const HEADING_ROW = 3;

    /**
     * Imports a collection of effects.
     *
     * @param \Illuminate\Support\Collection $collection
     * @throws \RuntimeException
     * @return void
     */
    public function collection(Collection $collection): void
    {
        $collection->each(function ($row) {
            $abilityId = Ability::query()->firstWhere('name', $row['name'])?->id;

            if ($abilityId === null) {
                throw new RuntimeException('Ability is missing - unable to import effects.');
            }

            if (! empty($row['recover_hp'])) {
                Ability::create([
                    'ability' => AbilityEffect::RECOVERY_HP,
                    'ability_id' => $abilityId,
                    'value' => $row['recover_hp'],
                    'is_boolean' => false,
                ]);
            }

            if (! empty($row['recover_sp'])) {
                Ability::create([
                    'ability' => AbilityEffect::RECOVERY_SP,
                    'ability_id' => $abilityId,
                    'value' => $row['recover_sp'],
                    'is_boolean' => false,
                ]);
            }

            if (! empty($row['paralysis'])) {
                Ability::create([
                    'ability' => AbilityEffect::PARALYSIS,
                    'ability_id' => $abilityId,
                    'value' => $row['paralysis'],
                    'is_boolean' => false,
                ]);
            }

            if (! empty($row['ohko_chance'])) {
                Ability::create([
                    'ability' => AbilityEffect::OHKO_CHANCE,
                    'ability_id' => $abilityId,
                    'value' => $row['ohko_chance'],
                    'is_boolean' => false,
                ]);
            }

            if (! empty($row['crit_chance'])) {
                Ability::create([
                    'ability' => AbilityEffect::ENHANCED_CRIT_CHANCE,
                    'ability_id' => $abilityId,
                    'value' => $row['crit_chance'],
                    'is_boolean' => false,
                ]);
            }

            if (! empty($row['hp_drain'])) {
                Ability::create([
                    'ability' => AbilityEffect::RECOVERY_SP,
                    'ability_id' => $abilityId,
                    'value' => (int) to_boolean($row['hp_drain']),
                    'is_boolean' => true,
                ]);
            }

            if (! empty($row['pure'])) {
                Ability::create([
                    'ability' => AbilityEffect::PURE,
                    'ability_id' => $abilityId,
                    'value' => (int) to_boolean($row['pure']),
                    'is_boolean' => true,
                ]);
            }
        });
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
                'exists:abilities,name',
            ],

            'recover_hp' => [
                'nullable',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'recover_sp' => [
                'nullable',
                'integer',
                new ExceedsMinimumStatRule(),
                new SubceedsMaximumStatRule(),
            ],

            'paralysis' => [
                'nullable',
                'integer',
                'gte:1',
                'lte:100',
            ],

            'ohko_chance' => [
                'nullable',
                'integer',
                'gte:1',
                'lte:100',
            ],

            'crit_chance' => [
                'nullable',
                'integer',
                'gte:1',
                'lte:100',
            ],

            'hp_drain' => [
                'nullable',
            ],

            'pure' => [
                'nullable',
            ],
        ];
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
