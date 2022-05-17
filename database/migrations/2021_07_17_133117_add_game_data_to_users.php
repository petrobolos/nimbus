<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->string('username')
                ->nullable()
                ->unique()
                ->after('name');
            $table
                ->date('date_of_birth')
                ->nullable()
                ->after('email');
            $table
                ->dateTime('muted_until')
                ->nullable()
                ->after('date_of_birth');
            $table
                ->dateTime('banned_until')
                ->nullable()
                ->after('muted_until');
            $table
                ->boolean('is_admin')
                ->default(false)
                ->index()
                ->after('profile_photo_path');
            $table
                ->json('meta')
                ->nullable()
                ->after('is_admin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'meta',
                'is_admin',
                'banned_until',
                'muted_until',
                'date_of_birth',
                'username',
            ]);
        });
    }
};
