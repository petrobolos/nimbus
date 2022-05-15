<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('perks', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('for_race_id')
                ->constrained('races')
                ->cascadeOnDelete();
            $table
                ->foreignId('against_race_id')
                ->constrained('races')
                ->cascadeOnDelete();
            $table
                ->unsignedBigInteger('type')
                ->index();
            $table
                ->text('description')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perks');
    }
};
