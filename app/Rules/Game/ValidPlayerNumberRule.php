<?php

namespace App\Rules\Game;

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
    public function passes(string $attribute, int $value): bool
    {
        return $value === 1 || $value === 2;
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
