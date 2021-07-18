<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Tests\TestCaseWithDatabase;

/**
 * Class PasswordConfirmationTest
 *
 * @package Tests\Feature
 */
final class PasswordConfirmationTest extends TestCaseWithDatabase
{
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
