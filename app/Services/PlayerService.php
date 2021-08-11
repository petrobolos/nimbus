<?php

namespace App\Services;

use App\Models\Fighter;
use App\Models\Player;
use App\Repositories\FighterRepository;

/**
 * Class PlayerService
 *
 * @package App\Services;
 */
class PlayerService
{
    protected FighterRepository $fighterRepository;

    /**
     * PlayerService constructor.
     *
     * @param \App\Repositories\FighterRepository $fighterRepository
     */
    public function __construct(FighterRepository $fighterRepository)
    {
        $this->fighterRepository = $fighterRepository;
    }

    /**
     * Create an AI-controlled player.
     *
     * @param array $roster
     * @return \App\Models\Player
     */
    public function createAiPlayer(array $roster): Player
    {
        $fighters = $this->fighterRepository->getFightersFromSlugRoster($roster);

        return Player::create([
            'user_id' => null,
            'fighter_id_1' => $fighters[0]->id,
            'fighter_id_2' => $fighters[1]->id ?? null,
            'fighter_id_3' => $fighters[2]->id ?? null,
            'current_fighter' => Player::FIGHTER_FIRST,
        ])->load('firstFighter', 'secondFighter', 'thirdFighter');
    }

    /**
     * Create a guest player. This is an alias of createAiPlayer since they're the same thing.
     *
     * @param array $roster
     * @see PlayerService::createAiPlayer()
     * @return \App\Models\Player
     */
    public function createGuestPlayer(array $roster): Player
    {
        return $this->createAiPlayer($roster);
    }
}
