<?php

use App\Models\Player;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table
                ->enum('current_fighter', [
                    Player::FIGHTER_FIRST,
                    Player::FIGHTER_SECOND,
                    Player::FIGHTER_THIRD,
                ])
                ->index()
                ->default(Player::FIGHTER_FIRST)
                ->after('fighter_id_3');
        });
    }

    public function down(): void
    {
        Schema::table('player', function (Blueprint $table) {
            $table->dropColumn('current_fighter');
        });
    }
};
