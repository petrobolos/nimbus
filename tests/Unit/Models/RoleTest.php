<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCaseWithDatabase;

/**
 * Class RoleTest
 *
 * @package Tests\Unit\Models
 */
final class RoleTest extends TestCaseWithDatabase
{
    public const NUMBER_OF_USERS = 3;

    public function test_all_users_of_a_given_role_can_be_retrieved(): void
    {
        $users = User::factory(self::NUMBER_OF_USERS)->create();

        self::assertContainsOnlyInstancesOf(User::class, $users);
    }
}
