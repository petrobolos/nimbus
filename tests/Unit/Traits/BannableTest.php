<?php

namespace Tests\Unit\Traits;

use App\Models\User;
use Tests\TestCaseWithDatabase;

final class BannableTest extends TestCaseWithDatabase
{
    public function test_a_users_ban_status_can_be_determined(): void
    {
        /** @var \App\Models\User $bannedUser */
        $bannedUser = User::factory()->banned()->create();

        /** @var \App\Models\User $unbannedUser */
        $unbannedUser = User::factory()->create();

        self::assertTrue($bannedUser->isBanned());
        self::assertFalse($unbannedUser->isBanned());
    }

    public function test_a_user_can_be_banned(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $user->ban();

        self::assertTrue($user->isBanned());
    }

    public function test_a_user_can_be_permanently_banned(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $user->permaban();

        self::assertTrue($user->isPermabanned());
    }

    public function test_a_user_can_be_unbanned(): void
    {
        /** @var \App\Models\User $bannedUser */
        $bannedUser = User::factory()->create();
        $bannedUser->unban();

        self::assertFalse($bannedUser->isBanned());
    }

    public function test_a_user_can_be_banned_for_a_specific_timeframe(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $timeframe = now()->addYear()->toDateTimeString();
        $user->ban($timeframe);

        self::assertTrue($user->isBanned());
        self::assertEquals($timeframe, $user->banned_until);
    }
}
