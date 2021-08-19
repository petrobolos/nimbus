<?php

namespace Tests\Unit\Classes\Game;

use App\Classes\Game\Action;
use App\Exceptions\Game\InvalidActionException;
use App\Models\Ability;
use App\Models\Fighter;
use Closure;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCaseWithDatabase;

/**
 * Class ActionTest
 *
 * @package Tests\Unit\Classes\Game
 */
final class ActionTest extends TestCaseWithDatabase
{
    use WithFaker;

    /** @dataProvider provideActions */
    public function test_can_construct_an_action_with_an_ability(Closure $factory, string $type): void
    {
        $model = $factory();

        try {
            $action = new Action(1, $model->id, $type);
        } catch (InvalidActionException $exception) {
            $this->fail($exception);
        }

        self::assertInstanceOf(Action::class, $action);
    }

    public function test_convert_method_will_compile_an_array_of_actions_into_full_action_objects(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $coinFlip = $this->faker->boolean();

            $actionsArray[] = [
                'actor' => $this->faker->randomNumber(2),
                'id' => $coinFlip
                    ? Ability::factory()->create()->id
                    : Fighter::factory()->create()->id,
                'type' => $coinFlip
                    ? Action::TYPE_ABILITY
                    : Action::TYPE_SWITCH,
            ];
        }

        $convertedActions = Action::convert($actionsArray);

        self::assertNotEmpty($convertedActions);
        self::assertContainsOnlyInstancesOf(Action::class, $convertedActions);
    }

    public function test_type_will_return_what_kind_of_action_the_instance_is(): void
    {
        $action = $this->actionFactory();

        self::assertEquals(Ability::class, $action->type());
    }

    /**
     * Returns a generated action for testing purposes.
     *
     * @return \App\Classes\Game\Action
     */
    public function actionFactory(): Action
    {
        try {
            return new Action(
                1,
                Ability::factory()->create()->id,
                Action::TYPE_ABILITY,
            );
        } catch (InvalidActionException $exception) {
            $this->fail($exception);
        }
    }

    /**
     * Provide a model factory closure and type to create actions.
     *
     * @return array[]
     */
    public function provideActions(): array
    {
        return [
            'Ability' => [
                static fn () => Ability::factory()->create(),
                Action::TYPE_ABILITY,
            ],
            'Skip' => [
                static fn () => Ability::factory()->create(['code' => 'skip']),
                Action::TYPE_SKIP,
            ],
            'Switch' => [
                static fn () => Fighter::factory()->create(),
                Action::TYPE_SWITCH,
            ],
        ];
    }
}
