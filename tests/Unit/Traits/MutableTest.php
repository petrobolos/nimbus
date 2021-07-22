<?php

namespace Tests\Unit\Traits;

use App\Models\User;
use Tests\TestCaseWithDatabase;

/**
 * Class MutableTest
 *
 * @package Tests\Unit\Traits
 */
final class MutableTest extends TestCaseWithDatabase
{
    public function test_a_users_mute_status_can_be_determined(): void
    {
        /** @var \App\Models\User $mutedUser */
        $mutedUser = User::factory()->muted()->create();

        /** @var \App\Models\User $unmutedUser */
        $unmutedUser = User::factory()->create();

        self::assertTrue($mutedUser->isMuted());
        self::assertFalse($unmutedUser->isMuted());
    }

    public function test_a_user_can_be_muted(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $user->mute();

        self::assertTrue($user->isMuted());
    }

    public function test_a_user_can_be_muted_for_a_specific_timeframe(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $timeframe = now()->addYear()->toDateTimeString();
        $user->mute($timeframe);

        self::assertTrue($user->isMuted());
        self::assertEquals($timeframe, $user->muted_until);
    }

    public function test_a_user_can_be_unmuted(): void
    {
        /** @var \App\Models\User $mutedUser */
        $mutedUser = User::factory()->muted()->create();
        $mutedUser->unmute();

        self::assertFalse($mutedUser->isMuted());
    }
}
