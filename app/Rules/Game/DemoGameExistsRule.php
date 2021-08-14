<?php

namespace App\Rules\Game;

use App\Models\Game;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class DemoGameExists.
 *
 * @package \App\Rules\Game
 */
class DemoGameExistsRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Game::where([
            ['against_ai', '=', true],
            ['id', '=', $value],
        ])->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'This demo game does not exist. Did it expire?';
    }
}
