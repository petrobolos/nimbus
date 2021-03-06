<?php

namespace App\Actions\GameLogic\Abilities;

use App\Models\GameLogic\Ability;
use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\Pivots\FighterAbility;

class AssignUniversalAbilities
{
    /**
     * Assign universal abilities to a fighter, and create them if needed.
     *
     * @param \App\Models\GameLogic\Fighter $fighter
     * @return void
     */
    public function execute(Fighter $fighter): void
    {
        $universalAbilities = config('nimbus.universal_abilities');

        foreach ($universalAbilities as $universalAbility) {
            if (Ability::query()->where('name', $universalAbility['name'])->doesntExist()) {
                $ability = Ability::create([
                    'name' => $universalAbility['name'],
                    'cost' => $universalAbility['cost'],
                    'type' => $universalAbility['type'],
                    'description' => $universalAbility['description'],
                    'is_universal' => true,
                ]);
            }

            $ability ??= Ability::query()->firstWhere('name', $universalAbility['name']);

            if (FighterAbility::query()
                ->where('fighter_id', $fighter->id)
                ->where('ability_id', $ability->id)
                ->doesntExist()
            ) {
                FighterAbility::create([
                    'fighter_id' => $fighter->id,
                    'ability_id' => $ability->id,
                ]);
            }
        }
    }
}
