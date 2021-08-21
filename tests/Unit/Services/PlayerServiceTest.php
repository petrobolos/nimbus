<?php

namespace Tests\Unit\Services;

use App\Models\Fighter;
use App\Services\PlayerService;
use Tests\TestCaseWithImportedData;
use Tests\Utils\Factories\FighterSlugArrayFactory;

/**
 * Class PlayerServiceTest
 *
 * @package Tests\Unit\Services
 */
final class PlayerServiceTest extends TestCaseWithImportedData
{
    protected PlayerService $playerService;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->playerService = app(PlayerService::class);
    }

    public function test_create_ai_player_produces_a_player_based_upon_a_roster_of_codes(): void
    {
        $fighters = FighterSlugArrayFactory::factory();
        $player = $this->playerService->createAiPlayer($fighters);

        self::assertNull($player->user);
        self::assertEquals($fighters[0], $player->firstFighter->code);
        self::assertEquals($fighters[1], $player->secondFighter->code);
        self::assertEquals($fighters[2], $player->thirdFighter->code);
    }

    public function test_create_guest_player_produces_a_player_based_upon_a_roster_of_codes(): void
    {
        $player = $this->playerService->createAiPlayer(FighterSlugArrayFactory::factory());

        self::assertInstanceOf(Fighter::class, $player->firstFighter);
        self::assertInstanceOf(Fighter::class, $player->secondFighter);
        self::assertInstanceOf(Fighter::class, $player->thirdFighter);
    }
}
