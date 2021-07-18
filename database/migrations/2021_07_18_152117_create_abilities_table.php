<?php

use App\Models\Ability;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->string('name')
                ->unique();
            $table
                ->string('code')
                ->unique();
            $table
                ->unsignedBigInteger('cost')
                ->default(0);
            $table
                ->enum('type', Ability::TYPES)
                ->default(Ability::TYPE_PHYSICAL);
            $table
                ->text('description')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abilities');
    }
};
