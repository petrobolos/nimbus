<?php

use App\Enums\GameMode;
use App\Enums\GameStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('webgames', function (Blueprint $table) {
            $table
                ->uuid('id')
                ->primary();
            $table
                ->unsignedBigInteger('game_type')
                ->default(GameMode::default())
                ->index();
            $table
                ->unsignedBigInteger('status')
                ->default(GameStatus::default())
                ->index();
            $table
                ->foreignId('player_1_id')
                ->nullable()
                ->constrained('players')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table
                ->foreignId('player_2_id')
                ->nullable()
                ->constrained('players')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table
                ->timestamp('started_at')
                ->nullable();
            $table
                ->timestamp('ended_at')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webgames');
    }
};
