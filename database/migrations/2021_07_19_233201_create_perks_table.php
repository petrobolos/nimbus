<?php

use App\Models\Perk;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('perks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('for_race');
            $table->unsignedBigInteger('against_race');
            $table
                ->enum('type', Perk::TYPES)
                ->default(Perk::TYPE_WEAKNESS);
            $table
                ->text('description')
                ->nullable();
            $table->timestamps();

            $table
                ->foreign('for_race')
                ->references('id')
                ->on('races')
                ->cascadeOnDelete();
            $table
                ->foreign('against_race')
                ->references('id')
                ->on('races')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perks');
    }
};
