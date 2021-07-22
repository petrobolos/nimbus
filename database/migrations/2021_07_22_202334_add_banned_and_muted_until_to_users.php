<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->dateTime('muted_until')
                ->nullable()
                ->after('last_signed_in');
            $table
                ->dateTime('banned_until')
                ->nullable()
                ->after('muted_until');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('banned_until');
            $table->dropColumn('muted_until');
        });
    }
};
