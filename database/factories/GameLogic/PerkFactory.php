<?php

namespace Database\Factories\GameLogic;

use App\Enums\GameLogic\Perks\PerkType;
use App\Models\GameLogic\Perk;
use App\Models\GameLogic\Race;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PerkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'for_race_id' => Race::factory()->create(),
            'against_race_id' => Race::factory()->create(),
            'type' => $this->faker->randomElement(PerkType::cases())->value,
            'description' => $this->faker->paragraphs(2, true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
