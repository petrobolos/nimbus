<?php

namespace Database\Factories;

use App\Models\Perk;
use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PerkFactory
 *
 * @package Database\Factories
 */
class PerkFactory extends Factory
{
    protected $model = Perk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'for_race' => static fn (): int => Race::factory()->create()->id,
            'against_race' => static fn (): int => Race::factory()->create()->id,
            'type' => $this->faker->randomElement(Perk::TYPES),
            'description' => $this->faker->text(),
        ];
    }
}
