<?php

namespace Tests\Unit\Rules\Demo;

use App\Models\Game;
use App\Rules\Game\Demo\DemoGameExistsRule;
use Tests\TestCaseWithImportedData;

/**
 * Class DemoGameExistsRuleTest
 *
 * @package Tests\Unit\Rules\Demo
 */
final class DemoGameExistsRuleTest extends TestCaseWithImportedData
{
    protected DemoGameExistsRule $rule;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = app(DemoGameExistsRule::class);
    }

    public function test_demo_game_existing_passes_rule(): void
    {
        $this->get(route('demo.show'))->assertOk();

        $game = Game::first();

        self::assertTrue($this->rule->passes('id', $game->id));
    }

    public function test_demo_game_if_not_in_progress_fails_rule(): void
    {
        $this->get(route('demo.show'))->assertOk();

        $game = Game::first();

        $game->update(['status' => Game::STATUS_ABANDONED]);

        self::assertFalse($this->rule->passes('id', $game->id));
    }

    public function test_demo_game_exists_rule_has_a_message_set(): void
    {
        self::assertNotEmpty($this->rule->message());
    }
}
