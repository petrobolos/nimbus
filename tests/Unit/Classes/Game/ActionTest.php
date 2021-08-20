<?php

namespace Tests\Unit\Classes\Game;

use App\Classes\Game\Action;
use App\Exceptions\Game\InvalidActionException;
use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Player;
use Closure;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCaseWithDatabase;
use Tests\Utils\Factories\ActionFactory;

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
            $action = new Action(Player::FIGHTER_FIRST, $model->id, $type);
        } catch (InvalidActionException $exception) {
            $this->fail($exception);
        }

        self::assertInstanceOf(Action::class, $action);
    }

    /** @throws \App\Exceptions\Game\InvalidActionException */
    public function test_convert_method_will_compile_an_array_of_actions_into_full_action_objects(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $actionsArray[] = ActionFactory::factory()->toArray();
        }

        $convertedActions = Action::convert($actionsArray);

        self::assertNotEmpty($convertedActions);
        self::assertContainsOnlyInstancesOf(Action::class, $convertedActions);
    }

    /** @throws \App\Exceptions\Game\InvalidActionException */
    public function test_type_will_return_what_kind_of_action_the_instance_is(): void
    {
        $action = ActionFactory::factory();

        self::assertEquals(Fighter::class, $action->type());
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
