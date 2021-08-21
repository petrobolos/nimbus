<?php

namespace Database\Factories;

use App\Models\Fighter;
use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class FighterFactory
 *
 * @package Database\Factories
 */
class FighterFactory extends Factory
{
    protected $model = Fighter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $statDigits = 3;
        $name = $this->faker->userName() . microtime(true);

        return [
            'name' => $name,
            'code' => Str::slug($name),
            'race_id' => static fn (): int => Race::factory()->create()->id,
            'current_hp' => Fighter::HEALTH_MAX,
            'current_sp' => Fighter::SP_MAX,
            'is_boss' => $this->faker->boolean(),
            'is_paralyzed' => $this->faker->boolean(),
            'hp' => $this->faker->randomNumber($statDigits),
            'attack' => $this->faker->randomNumber($statDigits),
            'defense' => $this->faker->randomNumber($statDigits),
            'speed' => $this->faker->randomNumber($statDigits),
            'special' => $this->faker->randomNumber($statDigits),
            'spirit' => $this->faker->randomNumber($statDigits),
            'last_form_id' => $this->faker->boolean() ? static fn (): int => Fighter::factory()->create()->id : null,
            'description' => $this->faker->text(),
        ];
    }
}
