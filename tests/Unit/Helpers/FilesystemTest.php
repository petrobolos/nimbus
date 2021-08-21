<?php

namespace Tests\Unit\Helpers;

use App\Exceptions\CopyrightNoticeMissingException;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

/**
 * Class FilesystemTest
 *
 * @package Tests\Unit\Helpers
 */
final class FilesystemTest extends TestCase
{
    public const COPYRIGHT_NEEDLE = 'The game will not operate without this copyright message present';

    /**
     * @throws \App\Exceptions\CopyrightNoticeMissingException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function test_copyright_notice_returns_the_correct_message(): void
    {
        $copyrightText = copyrightNotice();

        self::assertStringContainsStringIgnoringCase(self::COPYRIGHT_NEEDLE, $copyrightText);
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

    /**
     * @throws \App\Exceptions\CopyrightNoticeMissingException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function test_copyright_notice_can_be_retrieved_from_cache_instead_of_loaded_from_file_on_each_request(): void
    {
        $key = 'COPYRIGHT';

        Cache::shouldReceive('has')
            ->once()
            ->with($key)
            ->andReturn(true);

        Cache::shouldReceive('get')
            ->once()
            ->with($key)
            ->andReturn(file_get_contents(base_path($key)));

        $content = copyrightNotice();
        self::assertStringContainsStringIgnoringCase(self::COPYRIGHT_NEEDLE, $content);
    }
}
