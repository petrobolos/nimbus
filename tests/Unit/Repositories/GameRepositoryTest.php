<?php

namespace Tests\Unit\Repositories;

use App\Models\Game;
use App\Repositories\GameRepository;
use Tests\TestCaseWithDatabase;

/**
 * Class GameRepositoryTest
 *
 * @package Tests\Unit\Repositories
 */
final class GameRepositoryTest extends TestCaseWithDatabase
{
    protected GameRepository $repository;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app(GameRepository::class);
    }

    public function test_abandoned_or_concluded_games_can_be_retrieved(): void
    {
        $abandonedGame = Game::factory()->create([
            'status' => Game::STATUS_ABANDONED,
        ]);

        $concludedGame = Game::factory()->create([
            'status' => Game::STATUS_CONCLUDED,
        ]);

        // Produce an in-progress game and hope that it doesn't appear in the count.
        Game::factory()->create([
            'status' => Game::STATUS_IN_PROGRESS,
        ]);

        $games = $this->repository->abandonedOrConcludedGames()->get();

        self::assertCount(count([$abandonedGame, $concludedGame]), $games);
        self::assertContainsOnlyInstancesOf(Game::class, $games);
    }

    public function test_inactive_games_can_be_retrieved(): void
    {
        $staleGame = Game::factory()->create([
            'status' => Game::STATUS_IN_PROGRESS,
            'updated_at' => now()->subHour(),
        ]);

        $games = $this->repository->inactiveGames()->get();

        self::assertEquals($staleGame->id, $games->first()->id);
        self::assertContainsOnlyInstancesOf(Game::class, $games);
    }
}
