<?php

namespace App\Rules\Game;

use App\Classes\Game\Action;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ValidStateHistoryRule.
 *
 * @package App\Rules\Game
 */
class ValidStateHistoryRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param array $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (empty($value)) {
            return true;
        }

        return ! empty(Action::convert($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The state is corrupt and does not contain valid actions.';
    }
}
