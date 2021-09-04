<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('abilities', function (Blueprint $table) {
            $table
                ->json('effects')
                ->nullable()
                ->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('abilities', function (Blueprint $table) {
            $table->dropColumn('abilities');
        });
    }
};