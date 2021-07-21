<?php

namespace Tests\Unit\Models;

use App\Models\Fighter;
use App\Models\Race;
use Tests\TestCaseWithDatabase;

/**
 * Class FighterTest
 *
 * @package Tests\Unit\Models
 */
final class FighterTest extends TestCaseWithDatabase
{
    public function test_a_fighter_can_retrieve_their_race(): void
    {
        $fighter = Fighter::factory()->create();

        self::assertInstanceOf(Race::class, $fighter->race);
    }

    public function test_a_fighter_can_retrieve_their_previous_form_if_they_have_one(): void
    {
        $lastFormName = 'Test Subject';

        $fighter = Fighter::factory()->create([
            'last_form_id' => static fn (): int => Fighter::factory()->create(['name' => $lastFormName])->id,
        ]);

        self::assertInstanceOf(Fighter::class, $fighter->lastForm);
        self::assertEquals($lastFormName, $fighter->lastForm->name);
    }

    public function test_a_fighter_can_retrieve_its_next_forms_if_they_have_any(): void
    {
        $numberOfNextForms = 2;

        $fighter = Fighter::factory()->create();
        Fighter::factory($numberOfNextForms)->create([
            'last_form_id' => $fighter->id,
        ]);

        $nextForms = $fighter->nextForms;

        self::assertContainsOnlyInstancesOf(Fighter::class, $nextForms);
        self::assertCount($numberOfNextForms, $nextForms);
        self::assertEquals($fighter->id, $nextForms->first()->last_form_id);
    }

    public function get_all_forms_returns_a_tree_of_fighters_both_above_and_below_the_current_fighter(): void
    {
        $previousForm = Fighter::factory()->create();
        $fighter = Fighter::factory()->create(['last_form_id' => $previousForm->id]);
        $nextForm = Fighter::factory()->create(['last_form_id' => $fighter->id]);

        $collection = $fighter->getAllForms();

        self::assertContains($fighter, $collection);
        self::assertContains($previousForm, $collection);
        self::assertContains($nextForm, $collection);
    }
}
