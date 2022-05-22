<?php

namespace App\Actions\GameLogic\PartyMembers;

use App\Models\GameLogic\Fighter;
use App\Models\GameLogic\PartyMember;

class CreatePartyMember
{
    /**
     * Creates a live party member for use in a game from a given fighter template.
     *
     * @param \App\Models\GameLogic\Fighter $fighter
     * @return null|\App\Models\GameLogic\PartyMember
     */
    public function create(Fighter $fighter): ?PartyMember
    {
        return PartyMember::create([
            'fighter_id' => $fighter->id,
            'is_paralyzed' => false,
            'hp' => Fighter::STAT_MAX + $fighter->base_hp,
            'sp' => Fighter::STAT_MAX + $fighter->base_sp,
            'attack' => $fighter->base_attack,
            'defense' => $fighter->base_defense,
            'speed' => $fighter->base_speed,
            'special' => $fighter->base_special,
            'spirit' => $fighter->base_special,
        ]);
    }
}
