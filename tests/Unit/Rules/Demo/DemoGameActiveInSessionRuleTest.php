<?php

namespace Tests\Unit\Rules\Demo;

use App\Models\Game;
use App\Rules\Game\Demo\DemoGameActiveInSessionRule;
use Tests\TestCaseWithImportedData;

/**
 * Class DemoGameActiveInSessionRuleTest
 *
 * @package Tests\Unit\Rules\Demo
 */
final class DemoGameActiveInSessionRuleTest extends TestCaseWithImportedData
{
    protected DemoGameActiveInSessionRule $rule;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = app(DemoGameActiveInSessionRule::class);
    }

    public function test_games_not_in_session_fail_the_rule(): void
    {
        $game = Game::factory()->create();

        self::assertFalse($this->rule->passes('gameId', $game->id));
    }

    public function test_games_in_session_pass_the_rule(): void
    {
        $this->get(route('demo.show'))->assertOk();
        $game = Game::first();

        self::assertTrue($this->rule->passes('gameId', $game->id));
    }
}
