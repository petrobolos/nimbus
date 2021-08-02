<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

/**
 * Class StatSeeder
 *
 * @package Database\Seeders
 */
class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Stat::factory()->bronze()->create();
        Stat::factory()->silver()->create();
        Stat::factory()->gold()->create();
        Stat::factory()->platinum()->create();
        Stat::factory()->diamond()->create();
        Stat::factory()->master()->create();
        Stat::factory()->grandmaster()->create();
    }
}
