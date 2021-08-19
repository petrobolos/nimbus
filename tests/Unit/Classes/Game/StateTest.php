<?php

namespace Tests\Unit\Classes\Game;

use App\Models\Game;
use App\Models\Player;
use Tests\TestCaseWithDatabase;

final class StateTest extends TestCaseWithDatabase
{
    protected Game $game;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->game = Game::factory()->create();
    }

    public function test_initialize_will_set_up_a_game(): void
    {
        $state = $this->game->state;

        self::assertEquals(Player::FIGHTER_FIRST, $this->game->state->currentPlayer);
        self::assertIsArray($state->history);
    }

    public function test_get_first_turn_will_return_the_first_turn_from_state(): void
    {
        $this->markTestIncomplete();
    }

    public function test_get_last_turn_will_return_the_last_turn_from_state(): void
    {
        $this->markTestIncomplete();
    }

    public function test_has_game_started_will_return_false_if_the_state_is_yet_to_contain_any_actions(): void
    {
        self::assertFalse($this->game->state->hasGameStarted());
    }

    public function test_turns_will_return_zero_if_the_game_is_yet_to_start(): void
    {
        self::assertEquals(0, $this->game->state->turns());
    }

    public function test_turns_will_return_the_count_of_turns_if_the_game_has_started(): void
    {
        $this->markTestIncomplete();
    }

    public function test_compile_will_build_the_state_array_into_a_full_set_of_objects(): void
    {
        $this->markTestIncomplete();
    }
}
