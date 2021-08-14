<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table->unsignedBigInteger('sp')->default(0)->after('hp');
        });
    }

    public function down(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table->dropColumn('sp');
        });
    }
};
