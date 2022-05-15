<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('fighters', function (Blueprint $table) {
            $table->id();
            $table
                ->string('name')
                ->unique();
            $table
                ->string('description')
                ->nullable();
            $table
                ->unsignedBigInteger('base_hp')
                ->default(100);
            $table
                ->unsignedBigInteger('base_sp')
                ->default(100);
            $table
                ->unsignedBigInteger('base_attack')
                ->default(0);
            $table
                ->unsignedBigInteger('base_defense')
                ->default(0);
            $table
                ->unsignedBigInteger('base_speed')
                ->default(0);
            $table
                ->unsignedBigInteger('base_special')
                ->default(0);
            $table
                ->unsignedBigInteger('base_spirit')
                ->default(0);
            $table
                ->foreignId('last_form_id')
                ->nullable()
                ->constrained('fighters')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fighters');
    }
};
