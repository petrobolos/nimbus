<?php

namespace Tests\Unit\Models;

use App\Models\Perk;
use App\Models\Race;
use Tests\TestCaseWithDatabase;

/**
 * Class PerkTest
 *
 * @package Tests\Unit\Models
 */
final class PerkTest extends TestCaseWithDatabase
{
    public function test_a_perk_can_see_what_race_it_is_for(): void
    {
        $perk = Perk::factory()->create();

        self::assertInstanceOf(Race::class, $perk->for);
    }

    public function test_a_perk_can_see_what_race_it_is_against(): void
    {
        $perk = Perk::factory()->create();

        self::assertInstanceOf(Race::class, $perk->against);
    }
}
