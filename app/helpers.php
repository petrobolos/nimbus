<?php

use Illuminate\Support\Str;

if (! function_exists('to_boolean')) {
    /**
     * Converts a value into a Boolean. Defaults to a false value.
     *
     * @param mixed $value
     * @return bool
     */
    function to_boolean(mixed $value)
    {
        if (is_string($value)) {
            $value = Str::lower($value);
        }

        if (in_array($value, config('imports.acceptable_boolean_values.true'), false)) {
            return true;
        }

        return false;
    }
}
