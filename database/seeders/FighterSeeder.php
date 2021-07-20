<?php

namespace Database\Seeders;

use App\Models\Fighter;
use App\Models\Race;
use Illuminate\Database\Seeder;

/**
 * Class FighterSeeder
 *
 * @package Database\Seeders
 */
class FighterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Race::RACES as $race) {
            Fighter::factory()->create([
                'race_id' => Race::where('code', $race)->first()->id,
            ]);
        }
    }
}
