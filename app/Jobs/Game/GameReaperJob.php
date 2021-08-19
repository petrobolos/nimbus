<?php

namespace App\Jobs\Game;

use App\Models\Game;
use App\Repositories\GameRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class GameReaperJob.
 *
 * @package App\Jobs\Game
 */
class GameReaperJob implements ShouldQueue
{
    use Dispatchable;

    use InteractsWithQueue;

    use Queueable;

    use SerializesModels;

    public int $tries = 3;

    protected GameRepository $gameRepository;

    /**
     * GameReaperJob constructor.
     */
    public function __construct()
    {
        $this->gameRepository = app(GameRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $gamesAbandoned = $this->gameRepository->inactiveGames()->update(['status' => Game::STATUS_ABANDONED]);
            Log::info("A total of {$gamesAbandoned} have been marked as freshly abandoned.");

            $gameCount = $this->gameRepository->abandonedOrConcludedGames()->delete();
            Log::info("A total of {$gameCount} games have been reaped.");
        } catch (Throwable $throwable) {
            report($throwable);
            $this->fail($throwable);
        }
    }
}
