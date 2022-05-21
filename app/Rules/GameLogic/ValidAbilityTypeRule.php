<?php

namespace App\Rules\GameLogic;

use App\Enums\GameLogic\Abilities\AbilityType;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class ValidAbilityTypeRule implements Rule
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
        return Str::contains($value, AbilityType::TYPE_DESCRIPTIONS, true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The provided type is not a valid ability.';
    }
}
