<?php

use App\Enums\GameLogic\Abilities\AbilityType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table
                ->string('name')
                ->unique();
            $table
                ->boolean('is_universal')
                ->index()
                ->default(true);
            $table
                ->unsignedBigInteger('cost')
                ->index()
                ->default(0);
            $table
                ->integer('type')
                ->index()
                ->default(AbilityType::default());
            $table
                ->mediumText('description')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abilities');
    }
};
