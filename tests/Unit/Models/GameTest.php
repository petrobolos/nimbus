<?php

namespace Tests\Unit\Models;

use App\Enums\GameType;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Carbon;
use Tests\TestCaseWithDatabase;

/**
 * Class GameTest
 *
 * @package Tests\Unit\Models
 */
final class GameTest extends TestCaseWithDatabase
{
    public const SECONDS_IN_AN_HOUR = 3600;

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

    public function test_a_time_elapsed_duration_can_be_generated_for_ended_games(): void
    {
        Carbon::setTestNow(now());

        $game = Game::factory()->make([
            'created_at' => now()->subHour(),
            'updated_at' => now(),
            'status' => Game::STATUS_CONCLUDED,
        ]);

        self::assertEquals(self::SECONDS_IN_AN_HOUR, $game->timeElapsed);

        // Reset Carbon fake time.
        Carbon::setTestNow();
    }

    public function test_a_current_time_elapsed_can_be_generated_for_in_progress_games(): void
    {
        $timeNow = now();
        Carbon::setTestNow($timeNow);

        $game = Game::factory()->make([
            'created_at' => now()->subHour(),
            'status' => Game::STATUS_IN_PROGRESS,
        ]);

        self::assertEquals(self::SECONDS_IN_AN_HOUR, $game->timeElapsed);

        Carbon::setTestNow();
    }

    public function test_a_game_can_be_determined_to_be_against_the_ai(): void
    {
        $game = Game::factory()->againstCPU()->make();

        self::assertTrue($game->againstAi());
    }

    public function test_a_game_can_be_determined_to_be_ranked(): void
    {
        $game = Game::factory()->make(['ranked' => true]);

        self::assertTrue($game->isRanked());
    }

    public function test_a_game_description_can_be_generated(): void
    {
        $game = Game::factory()->make();

        self::assertStringContainsStringIgnoringCase('vs.', $game->description);
    }

    public function test_game_type_will_provide_a_correct_string_description_of_the_game_type(): void
    {
        $demo = Game::factory()->againstCPU()->make([
            'player_1' => static fn () => Player::factory()->cpu()->create(),
        ]);
        self::assertEquals(GameType::DEMO, $demo->gameType);

        $rankedGame = Game::factory()->make([
            'ranked' => true,
            'against_ai' => false,
        ]);
        self::assertEquals(GameType::RANKED, $rankedGame->gameType);

        $unrankedGame = Game::factory()->make([
            'ranked' => false,
            'against_ai' => false,
        ]);
        self::assertEquals(GameType::UNRANKED, $unrankedGame->gameType);

        $againstAi = Game::factory()->againstCPU()->make();
        self::assertEquals(GameType::AGAINST_AI, $againstAi->gameType);
    }
}
