<?php

namespace Tests\Feature\Http\Controllers\Pages;

use App\Models\User;
use Tests\TestCaseWithImportedData;

/**
 * Class DemoControllerTest
 *
 * @package Test\Feature\Http\Controllers\Pages
 */
final class DemoControllerTest extends TestCaseWithImportedData
{
    public function test_a_demo_game_can_be_created_in_its_entirety(): void
    {
        $response = $this->get(route('demo.show'));

        $response->assertOk();
        $response->assertSeeText('Guest vs. AI | Demo');
    }

    public function test_an_authenticated_user_cannot_access_the_demo(): void
    {
        $user = User::factory()->create();
        $this->be($user);

        $response = $this->get(route('demo.show'));
        $response->assertRedirect();
    }
}
