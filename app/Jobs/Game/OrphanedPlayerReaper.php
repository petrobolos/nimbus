<?php

namespace App\Jobs\Game;

use App\Repositories\PlayerRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use Throwable;

/**
 * Class OrphanedPlayerReaper
 *
 * @package App\Jobs\Game
 */
class OrphanedPlayerReaper implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    protected PlayerRepository $playerRepository;

    /**
     * AIGameReaperJob constructor.
     */
    public function __construct()
    {
        $this->playerRepository = app(PlayerRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $playerCount = $this->playerRepository->expiredGuestOrAiPlayers()->delete();
            Log::info("A total of {$playerCount} orphaned AI or guest players have been reaped.");
        } catch (Throwable $throwable) {
            report($throwable);
            $this->fail($throwable);
        }
    }
}