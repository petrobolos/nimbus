<?php

namespace Tests\Utils\Factories;

use App\Classes\Game\Action;
use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Game;

final class ActionFactory
{
    /**
     * Returns a generated action for testing purposes. Optional flag override.
     *
     * @param bool $switchInsteadOfAbility
     * @throws \App\Exceptions\Game\InvalidActionException
     * @return \App\Classes\Game\Action
     */
    public static function factory(bool $switchInsteadOfAbility = false): Action
    {
        return new Action(
            $switchInsteadOfAbility
                ? Game::PLAYER_FIRST
                : Game::PLAYER_SECOND,
            $switchInsteadOfAbility
                ? Ability::factory()->create()->id
                : Fighter::factory()->create()->id,
            $switchInsteadOfAbility
                ? Action::TYPE_ABILITY
                : Action::TYPE_SWITCH,
        );
    }
}
