<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table
                ->unsignedBigInteger('race_id')
                ->nullable()
                ->after('code');

            $table
                ->foreign('race_id')
                ->references('id')
                ->on('races')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table->dropForeign(['race_id']);
            $table->dropColumn('race_id');
        });
    }
};
