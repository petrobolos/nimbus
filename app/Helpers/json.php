<?php

use Illuminate\Support\Facades\Hash;

if (! function_exists('createArrayHash')) {
    /**
     * Converts an array into a hashed string.
     *
     * @param null|array $dataToEncode
     * @throws \JsonException
     * @return string
     */
    function createArrayHash(?array $dataToEncode = []): string
    {
        return Hash::make(json_encode($dataToEncode, JSON_THROW_ON_ERROR));
    }
}
