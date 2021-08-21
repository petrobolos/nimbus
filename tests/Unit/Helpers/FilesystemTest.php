<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;

/**
 * Class FilesystemTest
 *
 * @package Tests\Unit\Helpers
 */
final class FilesystemTest extends TestCase
{
    /**
     * @throws \App\Exceptions\CopyrightNoticeMissingException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function test_copyright_notice_returns_the_correct_message(): void
    {
        $expectedNeedle = 'The game will not operate without this copyright message present';
        $copyrightText = copyrightNotice();

        self::assertStringContainsStringIgnoringCase($expectedNeedle, $copyrightText);
    }
}
