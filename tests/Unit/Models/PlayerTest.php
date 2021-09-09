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

    public function test_fighter_attribute_returns_currently_active_fighter(): void
    {
        $player = Player::factory()->make();

        $player->current_fighter = Player::FIGHTER_FIRST;
        self::assertSame($player->fighter_id_1, $player->fighter->id);
        self::assertSame($player->firstFighter->id, $player->fighter->id);

        $player->current_fighter = Player::FIGHTER_SECOND;
        self::assertSame($player->fighter_id_2, $player->fighter->id);
        self::assertSame($player->secondFighter->id, $player->fighter->id);

        $player->current_fighter = Player::FIGHTER_THIRD;
        self::assertSame($player->fighter_id_3, $player->fighter->id);
        self::assertSame($player->thirdFighter->id, $player->fighter->id);
    }

    public function test_fighter_attribute_returns_null_on_invalid_value(): void
    {
        $player = Player::factory()->make();

        $player->current_fighter = 4;
        self::assertNull($player->fighter);
    }

    public function test_player_can_tell_whether_its_cpu_controlled_or_not(): void
    {
        /** @var \App\Models\Player $aiPlayer */
        $aiPlayer = Player::factory()->cpu()->make();

        self::assertTrue($aiPlayer->isCPU());
    }
}
