<?php

use App\Models\Role;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->unsignedBigInteger('key')
                ->unique();
            $table
                ->string('name')
                ->unique();
            $table
                ->text('description')
                ->nullable();
            $table->timestamps();
        });

        // Seed roles into the database, especially necessary for testing.
        if (Role::count() === 0) {
            Artisan::call('db:seed', [
                '--class' => RoleSeeder::class,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
