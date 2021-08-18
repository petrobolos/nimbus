<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class GameFactory
 *
 * @package Database\Factories
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'player_1' => static fn (): int => Player::factory()->create()->id,
            'player_2' => static fn (): int => Player::factory()->create()->id,
            'status' => $this->faker->randomElement(Game::STATUSES),
            'ranked' => $this->faker->boolean(),
            'against_ai' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate the game is against an AI-player.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function againstCPU(): Factory
    {
        return $this->state(function () {
            return [
                'player_2' => static fn (): int => Player::factory()->cpu()->create()->id,
                'against_ai' => true,
            ];
        });
    }
}
