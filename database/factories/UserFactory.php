<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 *
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'role_id' => $this->faker->randomKey(Role::ROLES),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'date_of_birth' => $this->faker->dateTimeThisCentury(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'preferred_locale' => 'en',
            'last_signed_in' => now(),
            'banned_until' => null,
            'muted_until' => null,
        ];
    }

    /**
     * Indicate that the user should be an administrator.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::ADMIN,
            ];
        });
    }

    /**
     * Indicate that the user should not be an administrator.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function notAnAdmin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => $this->faker->numberBetween(Role::PLAYER, Role::PREMIUM_PLAYER),
            ];
        });
    }

    /**
     * Indicate that the user should be banned.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function banned(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
               'banned_until' => now()->addWeek(),
           ];
        });
    }

    /**
     * Indicate that the user should be permanently banned.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function permabanned(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'banned_until' => config('game.bans.permaban_date'),
            ];
        });
    }

    /**
     * Indicate that the user should be muted.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function muted(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'muted_until' => now()->addWeek(),
            ];
        });
    }

    /**
     * Indicate that the user's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
