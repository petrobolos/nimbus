<?php

namespace Tests\Unit\Helpers;

use App\Exceptions\CopyrightNoticeMissingException;
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

    /** @throws \Psr\SimpleCache\InvalidArgumentException */
    public function test_copyright_notice_throws_an_exception_if_the_file_is_missing(): void
    {
        $copyrightFile = base_path('COPYRIGHT');

        if (! file_exists($copyrightFile)) {
            $this->markTestSkipped('Copyright file is missing - cannot perform this test...');
        }

        // Delete copyright file.
        $fileContents = file_get_contents($copyrightFile);
        unlink($copyrightFile);

        try {
            copyrightNotice();
            $this->fail('No exception was thrown...');
        } catch (CopyrightNoticeMissingException $exception) {
            self::assertInstanceOf(CopyrightNoticeMissingException::class, $exception);
        }

        // Recreate the file.
        clearstatcache();
        file_put_contents(base_path('COPYRIGHT'), $fileContents);
    }
}
