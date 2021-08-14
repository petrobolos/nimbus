<?php

namespace Tests\Unit\Helpers;

use Illuminate\Support\Carbon;
use Tests\TestCase;

final class DatetimeTest extends TestCase
{
    public function test_human_readable_datetime_returns_a_formatted_string(): void
    {
        $datetime = Carbon::parse('2021-08-14 13:27:28');
        $formattedString = 'August 14th 2021, 1:27pm';

        self::assertEquals($formattedString, humanReadableDatetime($datetime));
    }

    public function test_human_readable_datetime_returns_null_if_given_null(): void
    {
        self::assertNull(humanReadableDatetime(null));
    }
}
