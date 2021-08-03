<?php

namespace Tests\Unit\Models;

use App\Models\Stat;
use App\Models\User;
use Closure;
use Tests\TestCaseWithDatabase;

/**
 * Class StatTest
 *
 * @package Tests\Unit\Models
 */
final class StatTest extends TestCaseWithDatabase
{
    protected Stat $stat;

    /**
     * @dataProvider provideStatsAndRatings
     * @param string $rating
     * @param \Closure $factory
     */
    public function test_an_elo_can_be_translated_into_a_ranking(string $rating, Closure $factory): void
    {
        /** @var \App\Models\Stat $stats */
        $stats = $factory();

        self::assertEquals($rating, $stats->rating);
    }

    public function test_stats_can_retrieve_their_associated_user(): void
    {
        $stats = Stat::factory()->create();

        self::assertInstanceOf(User::class, $stats->user);
    }

    /**
     * Provide a stat and a stats model with its ELO set to the corresponding level.
     *
     * @return array[]
     */
    public function provideStatsAndRatings(): array
    {
        return [
            'Bronze' => [
                Stat::RATING_BRONZE,
                static fn () => Stat::factory()->bronze()->create(),
            ],

            'Silver' => [
                Stat::RATING_SILVER,
                static fn () => Stat::factory()->silver()->create(),
            ],

            'Gold' => [
                Stat::RATING_GOLD,
                static fn () => Stat::factory()->gold()->create(),
            ],

            'Platinum' => [
                Stat::RATING_PLATINUM,
                static fn () => Stat::factory()->platinum()->create(),
            ],

            'Diamond' => [
                Stat::RATING_DIAMOND,
                static fn () => Stat::factory()->diamond()->create(),
            ],

            'Master' => [
                Stat::RATING_MASTER,
                static fn () => Stat::factory()->master()->create(),
            ],

            'Grandmaster' => [
                Stat::RATING_GRANDMASTER,
                static fn () => Stat::factory()->grandmaster()->create(),
            ],
        ];
    }
}
