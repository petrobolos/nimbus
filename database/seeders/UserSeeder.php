<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class UserSeeder
 *
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Role::ROLES as $role => $data) {
            $username = Str::replace(' ', '.', $data['name']);
            $email = Str::lower($username);
            User::factory()->create([
                'username' => $username,
                'email' => "{$email}@dbgt.com",
                'role_id' => $role,
            ]);
        }
    }
}
