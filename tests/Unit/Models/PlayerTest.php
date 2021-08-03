<?php

namespace Tests\Unit\Models;

use App\Models\Fighter;
use App\Models\Player;
use App\Models\User;
use Tests\TestCaseWithDatabase;

/**
 * Class PlayerTest
 *
 * @package Tests\Unit\Models
 */
final class PlayerTest extends TestCaseWithDatabase
{
    protected Player $player;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->player = Player::factory()->make();
    }

    public function test_a_player_can_get_its_attached_user(): void
    {
        self::assertInstanceOf(User::class, $this->player->user);
    }

    public function test_a_player_can_get_its_first_fighter(): void
    {
        self::assertInstanceOf(Fighter::class, $this->player->firstFighter);
    }

    public function test_a_player_can_get_its_second_fighter(): void
    {
        self::assertInstanceOf(Fighter::class, $this->player->secondFighter);
    }

    public function test_a_player_can_get_its_third_fighter(): void
    {
        self::assertInstanceOf(Fighter::class, $this->player->thirdFighter);
    }

    public function test_player_can_tell_whether_its_cpu_controlled_or_not(): void
    {
        /** @var \App\Models\Player $aiPlayer */
        $aiPlayer = Player::factory()->cpu()->make();

        self::assertTrue($aiPlayer->isCPU());
    }
}
