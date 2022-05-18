<?php

namespace Database\Factories\GameLogic;

use App\Models\GameLogic\Fighter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FighterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fighter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->paragraphs(3, true),
            'base_hp' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'base_sp' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'base_attack' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'base_defense' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'base_speed' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'base_special' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'base_spirit' => $this->faker->numberBetween(Fighter::STAT_MIN, Fighter::STAT_MAX),
            'last_form_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate the model should have a previous form.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function evolved(): Factory
    {
        return $this->state(fn () => [
            'last_form_id' => Fighter::factory()->create(),
        ]);
    }
}
