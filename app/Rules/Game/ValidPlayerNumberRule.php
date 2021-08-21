<?php

namespace App\Rules\Game;

use App\Models\Game;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ValidPlayerNumberRule.
 *
 * @package App\Rules\Game
 */
class ValidPlayerNumberRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param int $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $value === Game::PLAYER_FIRST || $value === Game::PLAYER_SECOND;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The current player is not a valid player.';
    }
}
