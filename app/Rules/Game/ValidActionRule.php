<?php

namespace App\Rules\Game;

use App\Classes\Game\Action;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ValidActionRule
 *
 * @package App\Rules\Games
 */
class ValidActionRule implements Rule
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
        if (! is_array($value)) {
            return false;
        }

        return !empty(Action::convert([$value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The action is not of a valid format.';
    }
}
