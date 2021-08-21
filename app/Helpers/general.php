<?php

if (! function_exists('isProduction')) {
    /**
     * Returns whether the environment is currently in production.
     *
     * @return bool
     */
    function isProduction(): bool
    {
        return App::environment() === 'production';
    }
}
