<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;

/**
 * GeneralTest
 *
 * @package Tests\Unit\Helpers
 */
final class GeneralTest extends TestCase
{
    public function test_is_production_returns_false_during_unit_testing(): void
    {
        self::assertFalse(isProduction());
    }
}
