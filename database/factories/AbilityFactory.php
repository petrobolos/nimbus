<?php

namespace Database\Factories;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class AbilityFactory
 *
 * @package Database\Factories
 */
class AbilityFactory extends Factory
{
    protected $model = Ability::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'code' => Str::slug($name),
            'cost' => $this->faker->numberBetween(Ability::MIN_COST, Ability::MAX_COST),
            'type' => $this->faker->randomElement(Ability::TYPES),
            'description' => $this->faker->text(),
            'effects' => [],
        ];
    }
}
