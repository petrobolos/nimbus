<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('effects', function (Blueprint $table) {
            $table
                ->unsignedBigInteger('value')
                ->index()
                ->after('ability_id');

            $table
                ->boolean('is_boolean')
                ->index()
                ->default(false)
                ->after('value');
        });
    }

    public function down(): void
    {
        Schema::table('effects', function (Blueprint $table) {
            $table->dropColumn([
                'is_boolean',
                'value',
            ]);
        });
    }
};
