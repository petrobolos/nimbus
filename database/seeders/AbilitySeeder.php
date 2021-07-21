<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Pivots\FighterAbility;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    public const NUMBER_OF_ABILITIES_PER_FIGHTER = 3;
    public const NUMBER_OF_RANDOM_ABILITIES = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Fighter::count() !== 0) {
            // Generate
            foreach (Fighter::all() as $fighter) {
                $abilities = Ability::factory(self::NUMBER_OF_ABILITIES_PER_FIGHTER)->create();

                foreach ($abilities as $ability) {
                    FighterAbility::factory()->create([
                        'fighter_id' => $fighter->id,
                        'ability_id' => $ability->id,
                    ]);
                }
            }
        } else {
            // Generate a bunch of random abilities.
            foreach (Ability::TYPES as $type) {
                Ability::factory(self::NUMBER_OF_RANDOM_ABILITIES)->create([
                    'type' => $type,
                ]);
            }
        }
    }
}
