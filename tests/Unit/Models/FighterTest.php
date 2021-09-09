<?php

namespace Tests\Unit\Models;

use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Perk;
use App\Models\Pivots\FighterAbility;
use App\Models\Race;
use App\Support\RegularExpressions;
use Closure;
use Tests\TestCaseWithDatabase;

/**
 * Class FighterTest
 *
 * @package Tests\Unit\Models
 */
final class FighterTest extends TestCaseWithDatabase
{
    public function test_a_fighter_can_retrieve_their_abilities(): void
    {
        $fighter = Fighter::factory()->create();
        $ability = Ability::factory()->create();

        FighterAbility::factory()->create([
            'fighter_id' => $fighter->id,
            'ability_id' => $ability->id,
        ]);

        self::assertInstanceOf(Ability::class, $fighter->abilities->first());
        self::assertEquals($ability->id, $fighter->abilities->first()->id);
    }

    public function test_a_fighter_can_retrieve_their_race(): void
    {
        $fighter = Fighter::factory()->create();

        self::assertInstanceOf(Race::class, $fighter->race);
    }

    public function test_a_fighter_can_determine_if_it_is_a_boss(): void
    {
        $boss = Fighter::factory()->make(['is_boss' => true]);
        $nonBoss = Fighter::factory()->make(['is_boss' => false]);

        self::assertTrue($boss->isBoss());
        self::assertFalse($nonBoss->isBoss());
    }

    public function test_is_immune_to_ability_correctly_determines_if_a_fighter_is_immune_to_a_specific_kind_of_damage(): void
    {
        $attacking = Fighter::factory()->create();
        $defending = Fighter::factory()->create();

        Perk::factory()->create([
            'for_race' => $defending->race->id,
            'against_race' => $attacking->race->id,
            'type' => Perk::TYPE_PHYSICAL_IMMUNITY,
        ]);

        Perk::factory()->create([
            'for_race' => $defending->race->id,
            'against_race' => $attacking->race->id,
            'type' => Perk::TYPE_SPECIAL_IMMUNITY,
        ]);

        $physicalAbility = Ability::factory()->create(['type' => Ability::TYPE_PHYSICAL]);
        $specialAbility = Ability::factory()->create(['type' => Ability::TYPE_SPECIAL]);

        self::assertTrue($defending->isImmuneToAbility($attacking->race, $physicalAbility));
        self::assertTrue($defending->isImmuneToAbility($attacking->race, $specialAbility));

        // There also two circumstances in which should always return false: skips and recovery moves.
        $recoveryAbility = Ability::factory()->create(['type' => Ability::TYPE_RECOVERY]);
        $skipAbility = Ability::factory()->create(['code' => Ability::SKIP]);

        self::assertFalse($defending->isImmuneToAbility($attacking->race, $recoveryAbility));
        self::assertFalse($defending->isImmuneToAbility($attacking->race, $skipAbility));
    }

    /**
     * @dataProvider provideFightersAndAbilitiesForTestingResourceChecks
     * @param \Closure $fighterFactory
     * @param \Closure $abilityFactory
     * @param bool $expected
     */
    public function test_has_enough_resource_returns_the_correct_result_depending_on_the_fighters_current_sp_or_hp(Closure $fighterFactory, Closure $abilityFactory, bool $expected): void
    {
        /**
         * @var \App\Models\Fighter $fighter
         * @var \App\Models\Ability $ability
         */

        $fighter = $fighterFactory();
        $ability = $abilityFactory();

        self::assertSame($expected, $fighter->hasEnoughResource($ability));
    }

    /**
     * Provide fighters, abilities, and the expected output.
     *
     * @return array[]
     */
    public function provideFightersAndAbilitiesForTestingResourceChecks(): array
    {
        return [
            'Fighter with sufficient SP' => [
                static fn () => Fighter::factory()->make(['current_sp' => Fighter::SP_MAX]),
                static fn () => Ability::factory()->make(['cost' => 10]),
                true,
            ],

            'Fighter with insufficient SP' => [
                static fn () => Fighter::factory()->make(['current_sp' => Fighter::SP_MIN]),
                static fn () => Ability::factory()->make(['cost' => 10]),
                false,
            ],

            'Fighter with sufficient HP for an ability with HP drain' => [
                static fn () => Fighter::factory()->make(['current_hp' => Fighter::HEALTH_MAX]),
                static fn () => Ability::factory()->make(['cost' => 10, 'effects' => [Ability::EFFECT_HP_DRAIN => true]]),
                true,
            ],

            'Fighter with insufficient HP for an ability with HP drain' => [
                static fn () => Fighter::factory()->make(['current_hp' => 20]),
                static fn () => Ability::factory()->make(['cost' => 30, 'effects' => [Ability::EFFECT_HP_DRAIN => true]]),
                false,
            ],

            'Ability is free regardless of ability type and resource' => [
                static fn () => Fighter::factory()->make(),
                static fn () => Ability::factory()->make(['cost' => Ability::MIN_COST]),
                true,
            ],
        ];
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

    public function test_a_fighter_instance_can_get_a_unique_uuid_to_be_given_to_the_frontend(): void
    {
        $fighter = Fighter::factory()->create();

        self::assertMatchesRegularExpression(RegularExpressions::VALID_UUID, $fighter->uuid);
    }

    public function test_get_all_forms_returns_a_tree_of_fighters_both_above_and_below_the_current_fighter(): void
    {
        // FIXME: Fix this test along with the methods involved.
        $this->markTestIncomplete('This still needs to be fixed!');

        $previousForm = Fighter::factory()->create();
        $fighter = Fighter::factory()->create(['last_form_id' => $previousForm->id]);
        $nextForm = Fighter::factory()->create(['last_form_id' => $fighter->id]);

        $collection = $fighter->getAllForms();

        self::assertContains($fighter, $collection);
        self::assertContains($previousForm, $collection);
        self::assertContains($nextForm, $collection);
    }
}
