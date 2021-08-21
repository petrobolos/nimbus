<?php

namespace Tests\Feature\Http\Controllers\Pages;

use Tests\TestCaseWithImportedData;

final class DemoControllerTest extends TestCaseWithImportedData
{
    public function test_a_demo_game_can_be_created_in_its_entirety(): void
    {
        $response = $this->get(route('demo.show'));

        $response->assertOk();
        $response->assertSeeText('Guest vs. AI | Demo');
    }
}
