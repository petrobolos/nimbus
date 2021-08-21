<?php

namespace Tests\Feature\Http\Controllers\Pages;

use App\Models\User;
use Tests\TestCaseWithDatabase;

/**
 * Class FeedControllerTest
 *
 * @package Tests\Feature\Http\Controllers\Pages
 */
final class FeedControllerTest extends TestCaseWithDatabase
{
    public function test_authenticated_users_can_view_the_feed(): void
    {
        $user = User::factory()->create();
        $this->be($user);

        $response = $this->get(route('pages.feed'));
        $response->assertOk();
    }

    public function test_guests_cannot_view_the_feed(): void
    {
        $response = $this->get(route('pages.feed'));

        $response->assertRedirect();
    }
}
