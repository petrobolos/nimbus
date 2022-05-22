<?php

namespace App\Actions\GameLogic\Players;

use App\Actions\GameLogic\PartyMembers\CreatePartyMember;
use App\Models\GameLogic\Fighter;
use App\Models\Player;
use App\Services\Matchmaking\DemoService;
use Illuminate\Support\Arr;

class CreateCpuPlayer extends CreatePlayer
{
    /**
     * Creates a CPU player for a demo game.
     *
     * @return \App\Models\Player
     */
    public function create(): Player
    {
        $difficulty = app(DemoService::class)->getDemoDifficulty()->value;
        $roster = Arr::get(config('nimbus.ai.difficulties'), $difficulty);

        $roster = array_map(
            static fn (string $name) => Fighter::query()->firstWhere('name', $name),
            array_filter($roster),
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
