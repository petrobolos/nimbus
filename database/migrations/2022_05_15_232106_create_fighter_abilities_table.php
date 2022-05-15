<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('fighter_abilities', function (Blueprint $table) {
            $table->unsignedBigInteger('fighter_id')->index();
            $table->unsignedBigInteger('ability_id')->index();
            $table->primary(['fighter_id', 'ability_id']);
            $table->timestamps();
            $table
                ->foreign('fighter_id')
                ->references('id')
                ->on('fighters')
                ->cascadeOnDelete();
            $table
                ->foreign('ability_id')
                ->references('id')
                ->on('abilities')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fighter_abilities');
    }
};
