<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class RaceSeeder
 *
 * @package Database\Seeders
 */
class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Race::RACES as $race) {
            Race::factory()->create([
                'name' => ucwords(Str::replace('_', ' ', $race)),
                'code' => Str::slug($race, '_'),
            ]);
        }
    }
}
