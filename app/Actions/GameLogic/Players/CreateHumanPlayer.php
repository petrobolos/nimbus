<?php

namespace App\Actions\GameLogic\Players;

use App\Actions\GameLogic\PartyMembers\CreatePartyMember;
use App\Models\GameLogic\Fighter;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Collection;
use RuntimeException;

class CreateHumanPlayer extends CreatePlayer
{
    /**
     * Creates a player for use in-game.
     *
     * @param null|\App\Models\User $user
     * @param \Illuminate\Support\Collection $fighters
     * @param bool $isCpu
     * @throws \RuntimeException
     * @return null|\App\Models\GameLogic\PartyMember
     */
    public function create(?User $user, Collection $fighters, bool $isCpu = false): ?Player
    {
        if ($user === null) {
            return $isCpu
                ? app(CreateCpuPlayer::class)->create()
                : app(CreateGuestPlayer::class)->create();
        }

        if ($fighters->isEmpty()) {
            throw new RuntimeException('Cannot create a human-controlled player without fighters!');
        }

        $action = app(CreatePartyMember::class);
        $fighters = $fighters->filter()->map(static fn (Fighter $fighter) => $action->create($fighter));

        [$first, $second, $third] = $fighters + [null, null, null];

        return $this->compile(
            user: $user->id,
            first: $first?->id,
            second: $second?->id,
            third: $third?->id,
        );
    }
}
