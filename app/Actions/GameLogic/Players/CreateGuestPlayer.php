<?php

namespace App\Actions\GameLogic\Players;

use App\Actions\GameLogic\PartyMembers\CreatePartyMember;
use App\Models\GameLogic\Fighter;
use App\Models\Player;

class CreateGuestPlayer extends CreatePlayer
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

        $action = app(CreatePartyMember::class);
        $roster = array_map(static fn (Fighter $fighter) => $action->create($fighter), $roster);

        [$first, $second, $third] = $roster + [null, null, null];

        return $this->compile(
            user: null,
            first: $first?->id,
            second: $second?->id,
            third: $third?->id,
        );
    }
}
