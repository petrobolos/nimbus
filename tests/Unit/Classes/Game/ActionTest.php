<?php

namespace Tests\Unit\Classes\Game;

use App\Classes\Game\Action;
use App\Exceptions\Game\InvalidActionException;
use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Game;
use App\Models\Player;
use Closure;
use Exception;
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

    /** @throws \App\Exceptions\Game\InvalidActionException */
    public function test_type_will_return_null_if_for_whatever_reason_the_action_is_nullified(): void
    {
        $action = ActionFactory::factory();
        $action->model = null;

        self::assertNull($action->type());
    }

    public function test_an_action_will_throw_an_exception_if_the_model_does_not_exist(): void
    {
        $this->expectException(InvalidActionException::class);

        (new Action(
            Game::PLAYER_FIRST,
            1, // Not persisted to database.
            Action::TYPE_ABILITY,
        ));
    }

    public function test_an_action_will_throw_an_exception_if_an_invalid_type_is_provided(): void
    {
        $this->expectException(InvalidActionException::class);

        (new Action(
            Game::PLAYER_FIRST,
            Ability::factory()->create()->id,
            'Not a valid ability',
        ));
    }

    public function test_an_actions_context_from_the_exception_can_be_retrieved(): void
    {
        try {
            (new Action(
                Game::PLAYER_FIRST,
                Ability::factory()->create()->id,
                'Not a valid ability',
            ));
        } catch (Exception $exception) {
            self::assertInstanceOf(InvalidActionException::class, $exception);
            self::assertIsArray($exception->context());
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
