<?php

use App\Models\Game;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_1')->unique();
            $table->unsignedBigInteger('player_2')->unique();
            $table->string('status')->default(Game::STATUS_IN_PROGRESS);
            $table->boolean('ranked')->default(false);
            $table->boolean('against_ai')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('player_1')->references('id')->on('players')->cascadeOnDelete();
            $table->foreign('player_2')->references('id')->on('players')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
