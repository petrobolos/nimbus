<?php

namespace App\Imports\Sheets;

use App\Models\Ability;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 * Class AbilitiesEffects
 *
 * @package App\Imports\Sheets
 */
class AbilitiesEffects implements ToCollection, WithHeadingRow, WithProgressBar, WithValidation
{
    use Importable;

    public const HEADING_ROW = 2;

    /**
     * imports a collection of ability effects.
     *
     * @param \Illuminate\Support\Collection $collection
     */
    public function collection(Collection $collection): void
    {
        foreach ($collection as $row) {
            if (! isset($row['ability_code'])) {
                continue;
            }

            $model = Ability::where('code', $row['ability_code'])->first();
            if ($model === null) {
                continue;
            }

            $effects = [];
            foreach (Ability::EFFECTS as $effect) {
                $effects[$effect] = $row[$effect] ?? null;
            }

            $model->update(['effects' => $effects]);
        }
    }

    /**
     * Validate that the data in each column is correct.
     *
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'ability_code' => [
                'required',
                'string',
            ],

            'recover_hp' => [
                'nullable',
                'integer',
            ],

            'recover_sp' => [
                'nullable',
                'integer',
            ],

            'paralysis' => [
                'nullable',
                'integer',
            ],

            'ohko' => [
                'nullable',
                'integer',
            ],

            'crit_chance' => [
                'nullable',
                'integer',
            ],

            'hp_drain' => [
                'nullable',
                'boolean',
            ],

            'pure' => [
                'nullable',
                'boolean',
            ],
        ];
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
