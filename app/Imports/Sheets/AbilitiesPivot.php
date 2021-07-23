<?php

namespace App\Imports\Sheets;

use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Pivots\FighterAbility;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class AbilitiesPivot implements ToCollection, WithHeadingRow, WithProgressBar, WithValidation
{
    use Importable;

    public const HEADING_ROW = 2;

    /**
     * Exports a collection of fighter abilities.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return void
     */
    public function collection(Collection $collection): void
    {
        foreach ($collection as $row) {
            if (! isset($row['fighter_codes'])) {
                continue;
            }

            if ($row['fighter_codes'] === '*') {
                $fighters = Fighter::all('id');
                $fighters->map(function (Fighter $fighter) use ($row) {
                    FighterAbility::create([
                        'fighter_id' => $fighter->id,
                        'ability_id' => Ability::where('code', mb_strtolower($row['ability_code']))->first()->id,
                    ]);
                });
            } else {
                $fighters = explode(';', $row['fighter_codes']);

                foreach ($fighters as $fighter) {
                    FighterAbility::create([
                        'fighter_id' => Fighter::where('code', mb_strtolower($fighter))->first()->id,
                        'ability_id' => Ability::where('code', mb_strtolower($row['ability_code']))->first()->id,
                    ]);
                }
            }
        }
    }

    /**
     * Validate that the data in each column is correct.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'ability_code' => ['required', 'string'],
            'fighter_codes' => ['required', 'string'],
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
