<?php

namespace Tests\Unit\Rules;

use App\Models\Game;
use App\Rules\Game\InProgressRule;
use Closure;
use Tests\TestCaseWithDatabase;

/**
 * Class InProgressRuleTest
 *
 * @package Tests\Unit\Rules
 */
final class InProgressRuleTest extends TestCaseWithDatabase
{
    protected InProgressRule $rule;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = app(InProgressRule::class);
    }

    /** @dataProvider provideGamesAndBooleans */
    public function test_in_progress_games_pass_the_rule(Closure $factory, bool $expectedResult): void
    {
        $game = $factory();

        self::assertEquals($expectedResult, $this->rule->passes('id', $game->id));
    }

    /**
     * Provide a generated game with a different status and the expected result.
     *
     * @return array[]
     */
    public function provideGamesAndBooleans(): array
    {
        return [
            Game::STATUS_IN_PROGRESS => [
                static fn () => Game::factory()->create(['status' => Game::STATUS_IN_PROGRESS]),
                true,
            ],

            Game::STATUS_ABANDONED => [
                static fn () => Game::factory()->create(['status' => Game::STATUS_ABANDONED]),
                false,
            ],

            Game::STATUS_CONCLUDED => [
                static fn () => Game::factory()->create(['status' => Game::STATUS_CONCLUDED]),
                false,
            ],
        ];
    }
}
