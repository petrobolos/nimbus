<?php

namespace Database\Factories\GameLogic;

use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\PartyMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PartyMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartyMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'fighter_id' => Fighter::factory()->create(),
            'is_paralyzed' => $this->faker->boolean(),
            'hp' => Fighter::STAT_MAX,
            'sp' => Fighter::STAT_MAX,
            'attack' => Fighter::STAT_MAX,
            'defense' => Fighter::STAT_MAX,
            'speed' => Fighter::STAT_MAX,
            'special' => Fighter::STAT_MAX,
            'spirit' => Fighter::STAT_MAX,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate the model should be paralyzed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function paralyzed(): Factory
    {
        return $this->state(fn () => [
            'is_paralyzed' => true,
        ]);
    }

    /**
     * Indicate the model should have fainted.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function fainted(): Factory
    {
        return $this->state(fn () => [
            'hp' => Fighter::STAT_MIN,
        ]);
    }

    /**
     * Indicate the model should be discharged.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function discharged(): Factory
    {
        return $this->state(fn () => [
            'sp' => Fighter::STAT_MIN,
        ]);
    }
}
