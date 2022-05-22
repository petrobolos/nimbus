<?php

namespace App\Actions\GameLogic\Players;

use App\Models\GameLogic\PartyMember;
use App\Models\Player;

abstract class CreatePlayer
{
    /**
     * The final step in building a player object - of any kind.
     *
     * @param null|int $user
     * @param null|int $first
     * @param null|int $second
     * @param null|int $third
     * @return \App\Models\Player
     */
    public function compile(?int $user, ?int $first, ?int $second, ?int $third): Player
    {
        return Player::create([
            'user_id' => $user,
            'party_member_1_id' => $first,
            'party_member_2_id' => $second,
            'party_member_3_id' => $third,
            'current_party_member' => PartyMember::DEFAULT_PARTY_MEMBER,
        ]);
    }
}
