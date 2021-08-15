<?php

namespace App\Rules\Game;

use App\Models\Game;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class InProgressRule.
 *
 * @package App\Rules\Game
 */
class InProgressRule implements Rule
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
        $game = Game::select('status')->where('id', $value)->firstOrFail();

        return $game && $game->inProgress();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The game is no longer active.';
    }
}
