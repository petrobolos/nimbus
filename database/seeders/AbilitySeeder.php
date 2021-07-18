<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    public const NUMBER_OF_RANDOM_ABILITIES = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Ability::TYPES as $type) {
            Ability::factory(self::NUMBER_OF_RANDOM_ABILITIES)->create([
                'type' => $type,
            ]);
        }
    }
}
