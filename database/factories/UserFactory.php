<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->username(),
            'date_of_birth' => $this->faker->dateTimeThisCentury(),
            'muted_until' => null,
            'banned_until' => null,
            'email_verified_at' => Carbon::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => false,
            'meta' => [],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified(): Factory
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's should be an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin(): Factory
    {
        return $this->state(fn () => [
            'is_admin' => true,
        ]);
    }

    /**
     * Indicate that the model's should be banned.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function banned(): Factory
    {
        return $this->state(fn () => [
            'banned_until' => Carbon::now()->addYear(),
        ]);
    }

    /**
     * Indicate that the model's should be muted.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function muted(): Factory
    {
        return $this->state(fn () => [
            'muted_until' => Carbon::now()->addYear(),
        ]);
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam(): self
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
