<?php

use App\Models\Fighter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table
                ->boolean('is_paralyzed')
                ->after('is_boss')
                ->default(false);

            $table
                ->unsignedBigInteger('current_hp')
                ->after('race_id')
                ->default(Fighter::HEALTH_MAX);

            $table
                ->unsignedBigInteger('current_sp')
                ->after('current_hp')
                ->default(Fighter::SP_MAX);

            $table
                ->uuid('uuid')
                ->index()
                ->nullable()
                ->unique()
                ->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('fighters', function (Blueprint $table)
        {
            $table->dropColumn(['uuid', 'current_sp', 'current_hp', 'is_paralyzed']);
        });
    }
};
