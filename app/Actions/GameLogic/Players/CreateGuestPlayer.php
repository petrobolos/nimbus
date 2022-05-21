<?php

namespace App\Actions\GameLogic\Players;

use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\PartyMember;
use App\Models\Player;

class CreateGuestPlayer
{
    /**
     * Creates a guest player for a demo game.
     *
     * @return \App\Models\Player
     */
    public function create(): Player
    {
        $roster = array_map(
            static fn (string $name) => Fighter::query()->firstWhere('name', $name),
            config('nimbus.webgame.demo_roster')
        );

        [$first, $second, $third] = $roster;

        return Player::create([
            'user_id' => null,
            'party_member_1_id' => $first,
            'party_member_2_id' => $second,
            'party_member_3_id' => $third,
            'current_party_member_id' => PartyMember::DEFAULT_PARTY_MEMBER,
        ]);
    }
}
