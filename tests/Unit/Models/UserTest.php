<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use App\Models\User;
use Tests\TestCaseWithDatabase;

/**
 * Class UserTest
 *
 * @package Tests\Unit\Models
 */
final class UserTest extends TestCaseWithDatabase
{
    public function test_user_can_return_their_role(): void
    {
        $user = User::factory()->create();

        self::assertInstanceOf(Role::class, $user->role);
    }

    public function test_is_admin_will_return_true_if_the_given_user_is_an_administrator(): void
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->admin()->create();

        self::assertTrue($admin->isAdmin());
    }

    public function test_is_admin_will_return_false_if_the_given_user_is_not_an_administrator(): void
    {
        /** @var \App\Models\User $notAnAdmin */
        $notAnAdmin = User::factory()->notAnAdmin()->create();

        self::assertFalse($notAnAdmin->isAdmin());
    }
}
