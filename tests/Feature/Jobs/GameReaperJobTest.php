<?php

namespace Tests\Feature\Jobs;

use App\Jobs\Game\GameReaperJob;
use App\Models\Game;
use Exception;
use Illuminate\Support\Facades\Schema;
use Tests\TestCaseWithImportedData;

/**
 * Class GameReaperJobTest
 *
 * @package Tests\Feature\Jobs
 */
final class GameReaperJobTest extends TestCaseWithImportedData
{
    protected GameReaperJob $job;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->job = app(GameReaperJob::class);
    }

    /** @throws \Exception */
    public function test_inactive_games_are_reaped(): void
    {
        $count = 5;

        Game::factory($count)->create(['status' => Game::STATUS_ABANDONED]);

        $query = Game::where('status', '!=', Game::STATUS_IN_PROGRESS);
        self::assertEquals($count, $query->count());

        $this->job->handle();
        self::assertEmpty($query->get());
    }

    public function test_errors_are_handled_if_encountered_in_the_job(): void
    {
        $expectedCount = 1;

        Game::factory()->create(['status' => Game::STATUS_CONCLUDED]);
        self::assertCount($expectedCount, Game::all());

        // Mock a failure on deletion by blanking the database.
        Schema::dropIfExists('games');

        // An exception should be thrown since the table's missing.
        $this->expectException(Exception::class);
        $this->job->handle();
    }
}
