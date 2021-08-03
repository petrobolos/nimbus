<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

/**
 * Class GameSeeder
 *
 * @package Database\Seeders
 */
class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Game::factory(5)->create();
    }
}
