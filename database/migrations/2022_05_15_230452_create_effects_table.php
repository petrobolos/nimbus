<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('effects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ability')->index();
            $table->foreignId('ability_id')->constrained('abilities');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('effects');
    }
};
