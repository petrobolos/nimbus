<?php

namespace Tests\Feature\Http\Controllers\Pages;

use Tests\TestCase;

final class HomeControllerTest extends TestCase
{
    public function test_homepage_can_be_rendered(): void
    {
        $response = $this->get(route('pages.home'));

        $response->assertStatus(200);
    }
}
