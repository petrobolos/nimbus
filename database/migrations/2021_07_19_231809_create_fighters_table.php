<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fighters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->string('name')
                ->unique();
            $table
                ->string('code')
                ->unique();
            $table
                ->boolean('is_boss')
                ->default(false);
            $table->unsignedBigInteger('hp')->default(0);
            $table->unsignedBigInteger('attack')->default(0);
            $table->unsignedBigInteger('defense')->default(0);
            $table->unsignedBigInteger('speed')->default(0);
            $table->unsignedBigInteger('special')->default(0);
            $table->unsignedBigInteger('spirit')->default(0);
            $table
                ->unsignedBigInteger('last_form_id')
                ->nullable()
                ->default(null);
            $table
                ->text('description')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fighters');
    }
};
