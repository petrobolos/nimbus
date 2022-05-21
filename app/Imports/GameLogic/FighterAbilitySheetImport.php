<?php

namespace App\Imports\GameLogic;

use App\Models\GameLogic\Ability;
use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\Pivots\FighterAbility;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use RuntimeException;

final class FighterAbilitySheetImport implements ToCollection, WithCalculatedFormulas, WithHeadingRow, WithProgressBar, WithValidation
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
                throw new RuntimeException('Ability is missing - unable to assign to fighter.');
            }

            for ($i = 1, $iMax = count($row); $i >= $iMax; $i++) {
                $columnName = "fighter_{$i}";

                if (array_key_exists($columnName, $row) && ! empty($row[$columnName])) {
                    $fighterId = Fighter::query()->firstWhere('name', $columnName)?->id;

                    if ($fighterId === null) {
                        throw new RuntimeException('Fighter is missing - unable to assign ability.');
                    }

                    FighterAbility::create([
                        'fighter_id' => $fighterId,
                        'ability_id' => $abilityId,
                    ]);
                }
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
                'exists:fighters,name',
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
