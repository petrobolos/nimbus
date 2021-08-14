<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\User;
use Tests\TestCaseWithDatabase;

final class DashboardControllerTest extends TestCaseWithDatabase
{
    public function test_dashboard_is_visible_by_admins(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSeeText('Dashboard');
    }

    public function test_dashboard_is_not_visible_by_non_admins(): void
    {
        $nonAdmin = User::factory()->notAnAdmin()->create();

        $this->actingAs($nonAdmin);

        $response = $this->get(route('dashboard'));

        $response->assertRedirect();
    }

    public function test_dashboard_is_not_visible_by_guests(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect();
    }
}
