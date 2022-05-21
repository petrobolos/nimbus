<?php

namespace App\Rules\GameLogic;

use App\Models\GameLogic\Fighter;
use Illuminate\Contracts\Validation\Rule;

class ExceedsMinimumStatRule implements Rule
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
        return $value >= Fighter::STAT_MIN;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The value is less than the minimum allowed value for a stat.';
    }
}
