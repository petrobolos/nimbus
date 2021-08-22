<?php

namespace Tests\Feature\Jobs;

use App\Jobs\Game\OrphanedPlayerReaper;
use App\Models\Player;
use Tests\TestCaseWithImportedData;

/**
 * Class GameReaperJobTest
 *
 * @package Tests\Feature\Jobs
 */
final class OrphanedPlayerReaperTest extends TestCaseWithImportedData
{
    protected OrphanedPlayerReaper $job;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->job = app(OrphanedPlayerReaper::class);
    }

    public function test_orphaned_player_reaper_removes_old_ai_and_guest_players(): void
    {
        $count = 5;

        Player::factory($count)->cpu()->create([
            'updated_at' => now()->subHour(),
        ]);

        self::assertCount($count, Player::all());

        $this->job->handle();

        self::assertEmpty(Player::all());
    }
}
