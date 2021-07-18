<?php

namespace Tests\Feature\Http\Controllers\Pages;

use Tests\TestCase;

final class FaqControllerTest extends TestCase
{
    public function test_faq_page_can_be_rendered(): void
    {
        $response = $this->get(route('pages.faqs'));

        $response->assertStatus(200);
    }
}
