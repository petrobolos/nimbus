<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Class RoleSeeder
 *
 * @package Database\Seeders
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Role::count() === 0) {
            foreach (Role::ROLES as $role => $data) {
                Role::factory()->create([
                    'key' => $role,
                    'name' => $data['name'],
                    'description' => $data['description'],
                ]);
            }
        }
    }
}
