<?php

namespace Database\Factories;

use App\Models\Fighter;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PlayerFactory
 *
 * @package Database\Factories
 */
class PlayerFactory extends Factory
{
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => static fn (): int => User::factory()->create()->id,
            'fighter_id_1' => static fn (): int => Fighter::factory()->create()->id,
            'fighter_id_2' => static fn (): int => Fighter::factory()->create()->id,
            'fighter_id_3' => static fn (): int => Fighter::factory()->create()->id,
        ];
    }
}
