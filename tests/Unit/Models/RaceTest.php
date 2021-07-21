<?php

namespace Tests\Unit\Models;

use App\Models\Fighter;
use App\Models\Perk;
use App\Models\Race;
use Tests\TestCaseWithDatabase;

/**
 * Class RaceTest
 *
 * @package Tests\Unit\Models
 */
final class RaceTest extends TestCaseWithDatabase
{
    public const NUMBER_OF_TEST_SUBJECTS_TO_GENERATE = 5;

    public function test_a_race_can_see_what_fighters_they_consist_of(): void
    {
        $race = Race::factory()->create();

        Fighter::factory(self::NUMBER_OF_TEST_SUBJECTS_TO_GENERATE)->create([
            'race_id' => $race->id,
        ]);

        self::assertContainsOnlyInstancesOf(Fighter::class, $race->fighters);
        foreach ($race->fighters as $fighter) {
            self::assertEquals($race->id, $fighter->race->id);
        }
    }

    public function test_a_race_can_see_what_perks_exist_for_it(): void
    {
        $race = Race::factory()->create();

        Perk::factory(self::NUMBER_OF_TEST_SUBJECTS_TO_GENERATE)->create([
            'for_race' => $race->id,
        ]);

        self::assertContainsOnlyInstancesOf(Perk::class, $race->perksFor);
    }

    public function test_a_race_can_see_hat_perks_target_it(): void
    {
        $race = Race::factory()->create();

        Perk::factory(self::NUMBER_OF_TEST_SUBJECTS_TO_GENERATE)->create([
            'against_race' => $race->id,
        ]);

        self::assertContainsOnlyInstancesOf(Perk::class, $race->perksAgainst);
    }
}
