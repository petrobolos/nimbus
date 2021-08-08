<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\User;
use Tests\TestCaseWithDatabase;

final class BannedControllerTest extends TestCaseWithDatabase
{
    public function test_banned_page_displays_date(): void
    {
        $bannedUser = User::factory()->banned()->create();

        $this->actingAs($bannedUser);

        $response = $this->get(route('account.banned'));

        $response->assertOk();
        $response->assertSeeText('You are banned');
        $response->assertSeeText(humanReadableDatetime($bannedUser->banned_until));
    }

    public function test_banned_page_displays_permabanned_notice(): void
    {
        $permabannedUser = User::factory()->permabanned()->create();

        $this->actingAs($permabannedUser);

        $response = $this->get(route('account.banned'));

        $response->assertOk();
        $response->assertSeeText('You are banned');
        $response->assertSeeText('This ban will not expire');
    }

    public function test_banned_page_is_not_viewable_by_guests(): void
    {
        $response = $this->get(route('account.banned'));

        $response->assertRedirect();
    }

    public function test_banned_page_is_not_viewable_by_users_without_a_ban(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('account.banned'));

        $response->assertRedirect();
    }
}
