<?php

use App\Exceptions\CopyrightNoticeMissingException;

if (! function_exists('copyrightNotice')) {
    /**
     * Returns the COPYRIGHT notice contained in the copyright plaintext file.
     * Please don't remove this check.
     *
     * @throws \App\Exceptions\CopyrightNoticeMissingException|\Psr\SimpleCache\InvalidArgumentException|\Exception
     * @return string
     */
    function copyrightNotice(): string
    {
        $key = 'COPYRIGHT';

        if (cache()->has($key)) {
            return cache()->get($key);
        }

        $file = base_path($key);

        if (! file_exists($file)) {
            throw new CopyrightNoticeMissingException();
        }

        $textContent = strip_tags(file_get_contents($file));

        cache()->set($key, $textContent, now()->addDay());

        return $textContent;
    }
}
