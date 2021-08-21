<?php

namespace Tests\Unit\Repositories;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use Tests\TestCaseWithDatabase;

/**
 * Class PlayerRepositoryTest
 *
 * @package Tests\Unit\Repositories
 */
final class PlayerRepositoryTest extends TestCaseWithDatabase
{
    protected PlayerRepository $repository;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app(PlayerRepository::class);
    }

    public function test_expired_guest_or_ai_players_can_be_retrieved(): void
    {
        Player::factory()->cpu()->create([
            'updated_at' => now()->subHours(2),
        ]);

        $players = $this->repository->expiredGuestOrAiPlayers()->get();

        self::assertNotEmpty($players);
        self::assertContainsOnlyInstancesOf(Player::class, $players);
    }
}
