<?php

namespace Database\Factories;

use App\Enums\GameMode;
use App\Enums\GameStatus;
use App\Models\Player;
use App\Models\Webgame;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WebgameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Webgame::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'game_type' => $this->faker->randomElement(GameMode::singlePlayerModes())->value,
            'status' => $this->faker->randomElement(GameStatus::cases())->value,
            'player_1_id' => Player::factory(),
            'player_2_id' => Player::factory()->cpu(),
            'started_at' => null,
            'ended_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate that the game should be single player.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function singlePlayer(): Factory
    {
        return $this->state(fn () => [
            'game_type' => $this->faker->randomElement(GameMode::singlePlayerModes())->value,
            'player_2_id' => Player::factory()->cpu(),
        ]);
    }

    /**
     * Indicate that the game should be multiplayer.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function multiplayer(): Factory
    {
        return $this->state(fn () => [
            'game_type' => $this->faker->randomElement(GameMode::multiplayerModes())->value,
            'player_2_id' => Player::factory(),
        ]);
    }

    /**
     * Indicate that the game should be initialized and not started yet.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function initialized(): Factory
    {
        return $this->state(fn () => [
            'game_type' => $this->faker->randomElement(GameMode::multiplayerModes())->value,
            'status' => GameStatus::INITIALIZED,
            'player_2_id' => null,
            'started_at' => null,
        ]);
    }

    /**
     * Indicate that the game should be in progress.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inProgress(): Factory
    {
        return $this->state(fn () => [
            'status' => GameStatus::IN_PROGRESS,
            'started_at' => Carbon::now(),
        ]);
    }

    /**
     * Indicate that the game should be concluded.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function concluded(): Factory
    {
        return $this->state(fn () => [
            'status' => GameStatus::CONCLUDED,
            'started_at' => Carbon::now()->subHour(),
            'ended_at' => Carbon::now(),
            'created_at' => Carbon::now()->subHour(),
            'updated_at' => Carbon::now(),
        ]);
    }

    /**
     * Indicate that the game should be abandoned.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function abandoned(): Factory
    {
        return $this->state(fn () => [
            'status' => GameStatus::ABANDONED,
            'started_at' => Carbon::now()->subHour(),
            'ended_at' => Carbon::now(),
            'created_at' => Carbon::now()->subHour(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
