<?php

namespace Tests\Unit\Rules;

use App\Models\Game;
use App\Rules\Game\ValidPlayerNumberRule;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCaseWithDatabase;

/**
 * Class ValidPlayerNumberRuleTest
 *
 * @package Tests\Unit\Rules
 */
final class ValidPlayerNumberRuleTest extends TestCaseWithDatabase
{
    use WithFaker;

    protected ValidPlayerNumberRule $rule;

    /**
     * @inheritDoc
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = app(ValidPlayerNumberRule::class);
    }

    /** @dataProvider providePlayerNumbersAndBooleans */
    public function test_valid_player_numbers(int $playerNumber, bool $expectedResult): void
    {
        self::assertEquals($expectedResult, $this->rule->passes('number', $playerNumber));
    }

    /**
     * Provide a player number and the expected result.
     *
     * @return array[]
     */
    public function providePlayerNumbersAndBooleans(): array
    {
        return [
            'First Player' => [
                Game::PLAYER_FIRST,
                true,
            ],

            'Second Player' => [
                Game::PLAYER_SECOND,
                true,
            ],

            'Non-Existent Third Player' => [
                3,
                false,
            ],
        ];
    }
}
