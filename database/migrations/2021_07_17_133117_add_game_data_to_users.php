<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->string('username')
                ->unique()
                ->after('name');
            $table
                ->date('date_of_birth')
                ->after('email');
            $table
                ->dateTime('last_signed_in')
                ->nullable()
                ->after('remember_token');
            $table
                ->string('preferred_locale')
                ->default('en')
                ->after('remember_token');
            $table
                ->json('meta')
                ->nullable()
                ->after('preferred_locale');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('preferred_locale');
            $table->dropColumn('last_signed_in');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('username');
        });
    }
};
