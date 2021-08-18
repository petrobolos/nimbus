<?php

use App\Exceptions\CopyrightNoticeMissingException;

if (! function_exists('copyrightNotice')) {
    /**
     * Returns the COPYRIGHT notice contained in the copyright plaintext file.
     * Please don't remove this check.
     *
     * @throws \App\Exceptions\CopyrightNoticeMissingException
     * @return string
     */
    function copyrightNotice(): string
    {
        $file = base_path('COPYRIGHT');

        if (! file_exists($file)) {
            throw new CopyrightNoticeMissingException();
        }

        $content = fopen($file, 'rb');
        $textContent = '';

        while (! feof($content)) {
            $textContent .= fgets($content);
        }

        fclose($content);

        return strip_tags($textContent);
    }
}
