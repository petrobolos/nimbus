<?php

use Carbon\Carbon;

if (! function_exists('humanReadableDatetime')) {
    /**
     * Convert a Carbon datetime to an easy-to-read string. Returns null if unable to parse or if null is given.
     *
     * @param null|\Carbon\Carbon $datetime
     * @return null|string
     */
    function humanReadableDatetime(?Carbon $datetime): ?string
    {
        return $datetime?->isoFormat('MMMM Do YYYY, h:mma');
    }
}
