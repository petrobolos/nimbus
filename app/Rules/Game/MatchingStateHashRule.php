<?php

namespace App\Rules\Game;

use App\Models\Game;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class MatchingStateHashRule
 *
 * @package App\Rules\Game
 */
class MatchingStateHashRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param string $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $gameId = request('game_id') ?? request('gameId');
        $game = Game::findOrFail($gameId);

        return $value === $game->state_hash;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The state hashes do not match. State possibly out of sync.';
    }
}
