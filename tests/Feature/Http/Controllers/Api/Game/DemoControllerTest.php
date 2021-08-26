<?php

namespace Tests\Feature\Http\Controllers\Api\Game;

use App\Enums\Heartbeat;
use App\Models\Game;
use App\Models\User;
use App\Services\DemoService;
use Tests\TestCaseWithImportedData;
use Tests\Utils\Factories\ActionFactory;

/**
 * Class DemoControllerTest
 *
 * @package Tests\Feature\Http\Controllers\Api\Game
 */
final class DemoControllerTest extends TestCaseWithImportedData
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
    public function test_controller_can_respond_to_a_demo_heartbeat_with_a_heartbeat_response(): void
    {
        // Navigate to the demo page to set up a demo game.
        $this->get(route('demo.show'))->assertOk();

        // With the game fully configured, grab a copy of it.
        $demo = $this->demoService->startOrResumeDemo();

        // Post a heartbeat to the controller and evaluate its response.
        $response = $this->postJson(route('demo.ajax.heartbeat'), [
            'gameId' => $demo->id,
            'heartbeat' => Heartbeat::DEMO,
        ]);

        $response->assertOk();
        $response->assertJson([
            'heartbeat' => $demo->updated_at->toISOString(),
            'status' => $demo->status,
        ]);
    }

    public function test_controller_will_ignore_demo_heartbeat_requests_from_authenticated_users(): void
    {
        $user = User::factory()->create();
        $this->be($user);

        $response = $this->postJson(route('demo.ajax.heartbeat'), [
           'gameId' => Game::factory()->create()->id,
           'heartbeat' => Heartbeat::DEMO,
        ]);

        $response->assertRedirect();
    }

    /** @throws \Exception */
    public function test_controller_will_ignore_sync_requests_from_authenticated_users(): void
    {
        $user = User::factory()->create();
        $this->be($user);

        $game = Game::factory()->create();
        $response = $this->putJson(route('demo.ajax.sync'), [
            'gameId' => $game->id,
            'stateHash' => $game->state_hash,
            'state' => [
                'history' => [ActionFactory::factory()->toArray()],
                'currentPlayer' => $game->state->currentPlayer,
            ],
        ]);

        $response->assertRedirect();
    }

    /** @throws \Exception */
    public function test_controller_can_respond_to_a_sync_request_with_a_sync_response(): void
    {
        // Create a demo game.
        $this->get(route('demo.show'))->assertOk();
        $demo = $this->demoService->startOrResumeDemo();

        $response = $this->putJson(route('demo.ajax.sync'), [
            'gameId' => $demo->id,
            'stateHash' => $demo->state_hash,
            'state' => [
                'history' => [ActionFactory::factory()->toArray()],
                'currentPlayer' => $demo->state->currentPlayer,
            ],
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'stateHash',
            'state',
        ]);
    }
}
