<?php

namespace App\Rules\GameLogic;

use App\Models\GameLogic\Ability;
use Illuminate\Contracts\Validation\Rule;

class ExceedsMinimumCostRule implements Rule
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
        return $value >= Ability::MIN_COST;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The value is less than the minimum allowed value for a cost.';
    }
}
