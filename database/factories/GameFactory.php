<?php

namespace Database\Factories;

use App\Classes\Game\Action;
use App\Models\Ability;
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

    /**
     * Generate some state and add it to the game.
     *
     * @param \App\Models\Game $game
     * @return \App\Models\Game
     */
    public static function addState(Game $game): Game
    {
        $game->state->history = [
            [
                'actor' => Game::PLAYER_FIRST,
                'id' => Ability::factory()->create()->id,
                'type' => Action::TYPE_ABILITY,
            ],
            [
                'actor' => Game::PLAYER_SECOND,
                'id' => Ability::factory()->create()->id,
                'type' => Action::TYPE_ABILITY,
            ],
            [
                'actor' => Game::PLAYER_FIRST,
                'id' => Ability::factory()->create()->id,
                'type' => Action::TYPE_ABILITY,
            ],
        ];

        $game->state->currentPlayer = Game::PLAYER_SECOND;

        return $game;
    }
}
