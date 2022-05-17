<?php

use App\Enums\GameLogic\PartyMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table
                ->unsignedBigInteger('current_party_member_id')
                ->after('party_member_3_id')
                ->default(PartyMember::default())
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('current_party_member_id');
        });
    }
};
