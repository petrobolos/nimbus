<?php

namespace Database\Factories;

use App\Models\Stat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatFactory extends Factory
{
    protected $model = Stat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => static fn (): int => User::factory()->create()->id,
            'wins' => $this->faker->randomNumber(4),
            'losses' => $this->faker->randomNumber(4),
            'elo' => $this->faker->numberBetween(1000, 3000),
        ];
    }

    /**
     * Bronze-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bronze(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_BRONZE]]);
    }

    /**
     * Silver-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function silver(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_SILVER]]);
    }

    /**
     * Gold-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function gold(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_GOLD]]);
    }

    /**
     * Platinum-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function platinum(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_PLATINUM]]);
    }

    /**
     * Diamond-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function diamond(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_DIAMOND]]);
    }

    /**
     * Master-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function master(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_MASTER]]);
    }

    /**
     * Grandmaster-rated stats.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function grandmaster(): Factory
    {
        return $this->state(fn () => ['elo' => Stat::RATINGS[Stat::RATING_GRANDMASTER]]);
    }
}
