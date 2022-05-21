<?php

namespace Database\Factories;

use App\Enums\GameLogic\Abilities\AbilityEffect;
use App\Models\GameLogic\Ability;
use App\Models\GameLogic\Effect;
use Illuminate\Database\Eloquent\Factories\Factory;

class EffectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Effect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ability' => $this->faker->randomElement(AbilityEffect::effects())->value,
            'ability_id' => Ability::factory()->create(),
            'value' => $this->faker->numberBetween(0, 100),
            'is_boolean' => false,
        ];
    }

    /**
     * Indicate the effect should be a Boolean type.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function boolean(): Factory
    {
        return $this->state(fn () => [
            'value' => $this->faker->numberBetween(0, 1),
            'is_boolean' => $this->boolean(),
        ]);
    }
}
