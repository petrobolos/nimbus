<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('fighter_id_1')->nullable();
            $table->unsignedBigInteger('fighter_id_2')->nullable();
            $table->unsignedBigInteger('fighter_id_3')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('fighter_id_1')->references('id')->on('fighters')->cascadeOnDelete();
            $table->foreign('fighter_id_2')->references('id')->on('fighters')->cascadeOnDelete();
            $table->foreign('fighter_id_3')->references('id')->on('fighters')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
