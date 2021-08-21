<?php

namespace Tests\Unit\Services;

use App\Models\Game;
use App\Services\DemoService;
use App\Services\GameService;
use Tests\TestCaseWithImportedData;

final class GameServiceTest extends TestCaseWithImportedData
{
    protected GameService $gameService;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->gameService = app(GameService::class);
    }

    /** @throws \Exception */
    public function test_demo_will_return_a_fully_generated_demo_game(): void
    {
        $demoService = app(DemoService::class);

        $game = $this->gameService->demo(
            $demoService->getPlayerDemoTeam(),
            $demoService->determineDemoTeam(),
        );

        self::assertSame($game->game_type, 'Demo');
        self::assertTrue($game->inProgress());
        self::assertTrue($game->againstAi());
    }

    public function test_abandon_returns_true_on_successful_abandonment(): void
    {
        $game = Game::factory()->create([
            'status' => Game::STATUS_IN_PROGRESS,
            'updated_at' => now()->subHour()
        ]);

        $alreadyAbandonedGame = Game::factory()->create([
            'status' => Game::STATUS_ABANDONED,
        ]);

        self::assertTrue($this->gameService->abandon($game));
        self::assertTrue($this->gameService->abandon($alreadyAbandonedGame));

        $game->refresh();
        self::assertTrue($game->abandoned());
    }

    public function test_in_progress_games_or_concluded_games_cannot_be_abandoned(): void
    {
        $game = Game::factory()->create([
            'status' => Game::STATUS_CONCLUDED,
        ]);

        $inProgressGame = Game::factory()->create([
            'status' => Game::STATUS_IN_PROGRESS,
        ]);

        self::assertFalse($this->gameService->abandon($game));
        self::assertFalse($this->gameService->abandon($inProgressGame));
    }
}
