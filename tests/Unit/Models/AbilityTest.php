<?php

namespace Tests\Unit\Models;

use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Pivots\FighterAbility;
use Tests\TestCaseWithDatabase;

/**
 * Class AbilityTest
 *
 * @package Tests\Unit\Models
 */
final class AbilityTest extends TestCaseWithDatabase
{
    public function test_an_ability_can_retrieve_the_fighters_that_have_it(): void
    {
        $fighter = Fighter::factory()->create();
        $ability = Ability::factory()->create();

        FighterAbility::factory()->create([
            'fighter_id' => $fighter->id,
            'ability_id' => $ability->id,
        ]);

        self::assertInstanceOf(Fighter::class, $ability->fighters->first());
        self::assertEquals($fighter->id, $ability->fighters->first()->id);
    }

    public function test_is_skip_correctly_detects_a_move_as_the_turn_skipper(): void
    {
        $skip = Ability::factory()->make(['code' => Ability::SKIP]);
        $notSkip = Ability::factory()->make();

        self::assertTrue($skip->isSkip());
        self::assertFalse($notSkip->isSkip());
    }
}
