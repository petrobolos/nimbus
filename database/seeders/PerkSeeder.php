<?php

namespace Database\Seeders;

use App\Models\Perk;
use App\Models\Race;
use Illuminate\Database\Seeder;

/**
 * Class PerkSeeder
 *
 * @package Database\Seeders
 */
class PerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Race::RACES as $race) {
            // Give each race a random weakness, resistance, super effectiveness, and ineffectiveness.
            foreach (Perk::TYPES as $type) {
                Perk::factory()->create([
                    'for_race' => Race::where('code', $race)->first()->id,
                    'against_race' => Race::inRandomOrder()->first()->id,
                    'type' => $type,
                ]);
            }
        }
    }
}
