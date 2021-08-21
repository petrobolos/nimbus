<?php

namespace Tests\Unit\Services;

use App\Enums\Difficulty;
use App\Models\Game;
use App\Services\DemoService;
use Exception;
use Illuminate\Support\Facades\App;
use Tests\TestCaseWithImportedData;

/**
 * Class DemoServiceTest
 *
 * @package Tests\Unit\Services
 */
final class DemoServiceTest extends TestCaseWithImportedData
{
    protected DemoService $demoService;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->demoService = app(DemoService::class);
    }

    /** @throws \Exception */
    public function test_get_demo_information_returns_an_object_with_demo_info(): void
    {
        $data = $this->demoService->getDemoInformation();

        self::assertObjectHasAttribute('demo_id', $data);
        self::assertObjectHasAttribute('difficulty', $data);
        self::assertObjectHasAttribute('completion', $data);
    }

    /** @throws \Exception */
    public function test_demo_games_can_be_started_for_the_first_time(): void
    {
        self::assertEmpty(Game::all());

        $demo = $this->demoService->startOrResumeDemo();

        self::assertEquals($demo->id, Game::first()->id);
    }

    /** @throws \Exception */
    public function test_demo_games_can_be_retrieved_after_being_started(): void
    {
        $startDemo = $this->demoService->startOrResumeDemo();
        $resumeDemo = $this->demoService->startOrResumeDemo();

        self::assertCount(1, Game::all());
        self::assertEquals($startDemo->id, $resumeDemo->id);
    }

    /** @throws \Exception */
    public function test_a_new_demo_game_will_be_created_after_the_first_one_expires(): void
    {
        $startDemo = $this->demoService->startOrResumeDemo();
        $startDemo->update(['status' => Game::STATUS_ABANDONED]);

        $newDemo = $this->demoService->startOrResumeDemo();

        self::assertNotEquals($startDemo->id, $newDemo->id);
    }

    public function test_retrieve_the_demo_roster(): void
    {
        $demoTeam = $this->demoService->getPlayerDemoTeam();

        self::assertIsArray($demoTeam);
        self::assertNotEmpty($demoTeam);
    }

    /** @throws \Exception */
    public function test_retrieve_the_demo_team_for_use_of_the_ai(): void
    {
        $difficulty = $this->demoService->getDemoDifficulty();

        $roster = $this->demoService->determineDemoTeam();

        self::assertEquals(
            config("demo.roster.{$difficulty}"),
            $roster,
        );
    }

    /** @throws \Exception */
    public function test_retrieve_a_random_demo_team_for_the_ai_after_the_demo_is_completed(): void
    {
        $this->demoService->setDemoCompletion();

        $roster = $this->demoService->determineDemoTeam();

        self::assertContains($roster, config('demo.roster'));
    }

    /** @throws \Exception */
    public function test_get_demo_game_returns_a_demo_if_one_is_in_progress(): void
    {
        $demo = $this->demoService->startOrResumeDemo();

        self::assertEquals(
            $demo->id,
            $this->demoService->getDemoGame(),
        );
    }

    public function test_get_demo_game_returns_null_if_no_demo_is_in_progress(): void
    {
        self::assertNull($this->demoService->getDemoGame());
    }

    public function test_set_demo_game_will_store_a_demo_game_id_for_later_retrieval(): void
    {
        $game = Game::factory()->create();

        $this->demoService->setDemoGame($game->id);

        self::assertEquals(
            $game->id,
            $this->demoService->getDemoGame()
        );
    }

    /** @throws \Exception */
    public function test_get_demo_difficulty_will_return_hard_by_default_outside_of_production(): void
    {
        self::assertEquals(Difficulty::HARD, $this->demoService->getDemoDifficulty());
    }

    /** @throws \Exception */
    public function test_get_demo_difficulty_will_return_easy_by_default(): void
    {
        App::shouldReceive('environment')
            ->once()
            ->andReturn('production');

        self::assertEquals(Difficulty::EASY, $this->demoService->getDemoDifficulty());
    }

    /** @throws \Exception */
    public function test_demo_difficulty_can_be_set_and_retrieved(): void
    {
        $this->demoService->setDemoDifficulty(Difficulty::MEDIUM);

        self::assertEquals(
            Difficulty::MEDIUM,
            $this->demoService->getDemoDifficulty()
        );
    }

    /** @throws \Exception */
    public function test_demo_difficulty_will_reject_invalid_difficulties(): void
    {
        $this->expectException(Exception::class);

        $this->demoService->setDemoDifficulty('Not a valid difficulty');
    }

    public function test_incomplete_demo_returns_false(): void
    {
        self::assertFalse($this->demoService->getDemoCompletion());
    }

    public function test_demo_can_be_completed_and_later_retrieved(): void
    {
        $this->demoService->setDemoCompletion();

        self::assertTrue($this->demoService->getDemoCompletion());
    }
}
