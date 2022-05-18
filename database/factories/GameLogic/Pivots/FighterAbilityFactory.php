<?php

namespace Database\Factories\GameLogic\Pivots;

use App\Models\GameLogic\Ability;
use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\Pivots\FighterAbility;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FighterAbilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FighterAbility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'fighter_id' => Fighter::factory(),
            'ability_id' => Ability::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
