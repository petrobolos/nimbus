<?php

namespace Database\Factories\Pivots;

use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Pivots\FighterAbility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class FighterAbilityFactory
 *
 * @package Database\Factories\Pivots
 */
class FighterAbilityFactory extends Factory
{
    protected $model = FighterAbility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'fighter_id' => static fn (): int => Fighter::factory()->create()->id,
            'ability_id' => static fn (): int => Ability::factory()->create()->id,
        ];
    }
}
