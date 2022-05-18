<?php

namespace Database\Factories\GameLogic;

use App\Enums\GameLogic\Abilities\AbilityType;
use App\Models\GameLogic\Ability;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AbilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ability::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'is_universal' => false,
            'cost' => $this->faker->numberBetween(Ability::MIN_COST, Ability::MAX_COST),
            'type' => $this->faker->randomElement(AbilityType::types())->value,
            'description' => $this->faker->paragraphs(2, true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate the ability should be universal.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function universal(): Factory
    {
        return $this->state(fn () => [
            'is_universal' => true,
        ]);
    }
}
