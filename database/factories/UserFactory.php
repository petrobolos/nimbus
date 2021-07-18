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
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
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
        ];
    }

    /**
     * Indicate that the model should be an administrator.
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
     * Indicate that the model should not be an administrator.
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
     * Indicate that the model's email address should be unverified.
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
