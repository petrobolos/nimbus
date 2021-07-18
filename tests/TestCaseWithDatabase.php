<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class TestCaseWithDatabase
 *
 * @package Tests
 */
abstract class TestCaseWithDatabase extends TestCase
{
    use RefreshDatabase;
}
