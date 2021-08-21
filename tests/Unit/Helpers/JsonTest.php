<?php

namespace Tests\Unit\Helpers;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Class JsonTest
 *
 * @package Test\Unit\Helpers
 */
final class JsonTest extends TestCase
{
    /** @throws \JsonException */
    public function test_create_array_hash_returns_an_accurate_hash_value_of_a_json_encoded_array(): void
    {
        $arrayToHash = ['test' => 'test'];
        $jsonEncodedArrayForVerification = json_encode($arrayToHash, JSON_THROW_ON_ERROR);

        $hashedArray = createArrayHash($arrayToHash);

        self::assertTrue(Hash::check($jsonEncodedArrayForVerification, $hashedArray));
    }
}
