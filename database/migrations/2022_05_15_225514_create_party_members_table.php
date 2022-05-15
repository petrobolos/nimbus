<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('party_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fighter_id')->constrained('fighters');
            $table->boolean('is_paralyzed')->default(false);
            $table->unsignedBigInteger('hp');
            $table->unsignedBigInteger('sp');
            $table->unsignedBigInteger('attack');
            $table->unsignedBigInteger('defense');
            $table->unsignedBigInteger('speed');
            $table->unsignedBigInteger('special');
            $table->unsignedBigInteger('spirit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('party_members');
    }
};
