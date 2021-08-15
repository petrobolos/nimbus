<?php

namespace App\Rules\Game\Demo;

use App\Models\Game;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class DemoGameExists.
 *
 * @package \App\Rules\Game\Demo
 */
class DemoGameExistsRule implements Rule
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
        return Game::where([
            ['status', '=', Game::STATUS_IN_PROGRESS],
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
