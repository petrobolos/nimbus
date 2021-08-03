<?php

namespace Tests\Unit\Models;

use App\Models\Game;
use App\Models\Player;
use Tests\TestCaseWithDatabase;

/**
 * Class GameTest
 *
 * @package Tests\Unit\Models
 */
final class GameTest extends TestCaseWithDatabase
{
    protected Game $game;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->game = Game::factory()->make();
    }

    public function test_a_game_can_get_its_first_player(): void
    {
        self::assertInstanceOf(Player::class, $this->game->firstPlayer);
    }

    public function test_a_game_can_get_its_second_player(): void
    {
        self::assertInstanceOf(Player::class, $this->game->secondPlayer);
    }

    public function test_a_game_can_be_determined_to_be_in_progress(): void
    {
        $game = Game::factory()->make(['status' => Game::STATUS_IN_PROGRESS]);

        self::assertTrue($game->inProgress());
    }

    public function test_a_game_can_be_determined_to_be_concluded(): void
    {
        $game = Game::factory()->make(['status' => Game::STATUS_CONCLUDED]);

        self::assertTrue($game->concluded());
    }

    public function test_a_game_can_be_determined_to_be_abandoned(): void
    {
        $game = Game::factory()->make(['status' => Game::STATUS_ABANDONED]);

        self::assertTrue($game->abandoned());
    }
}
