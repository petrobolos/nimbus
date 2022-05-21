<?php

namespace App\Rules\GameLogic;

use App\Models\GameLogic\Ability;
use Illuminate\Contracts\Validation\Rule;

class SubceedsMaximumCostRule implements Rule
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
        return $value <= Ability::MAX_COST;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The value is more than than the maximum allowed value for a cost.';
    }
}
