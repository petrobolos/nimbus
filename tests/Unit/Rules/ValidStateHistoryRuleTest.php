<?php

namespace Tests\Unit\Rules;

use App\Models\Game;
use App\Rules\Game\ValidStateHistoryRule;
use Tests\TestCaseWithDatabase;
use Tests\Utils\Factories\ActionFactory;

/**
 * Class ValidStateHistoryRuleTest
 *
 * @package Tests\Unit\Rules
 */
final class ValidStateHistoryRuleTest extends TestCaseWithDatabase
{
    protected ValidStateHistoryRule $rule;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = app(ValidStateHistoryRule::class);
    }

    /** @throws \App\Exceptions\Game\InvalidActionException */
    public function test_valid_state_history(): void
    {
        // The fun job of converting objects into arrays and back into objects.
        $stateHistory = [
            ActionFactory::factory()->toArray(),
            ActionFactory::factory()->toArray(),
            ActionFactory::factory()->toArray(),
        ];

        self::assertTrue($this->rule->passes('actions', $stateHistory));
    }

    public function test_valid_state_history_for_new_games(): void
    {
        self::assertTrue($this->rule->passes('actions', Game::factory()->create()->state->history));
    }

    /** @throws \App\Exceptions\Game\InvalidActionException */
    public function test_invalid_state_is_rejected(): void
    {
        $invalidStateHistory = [
            [
                ActionFactory::factory()->toArray(),
                ActionFactory::factory()->toArray(),
                [
                    'invalid' => 'data',
                ],
                'notEvenAnArray',
            ],
        ];

        self::assertFalse($this->rule->passes('actions', $invalidStateHistory));
    }
}
