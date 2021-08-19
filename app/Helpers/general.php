<?php

if (! function_exists('isLocalEnv')) {
    /**
     * Returns whether the environment is currently in production.
     *
     * @return bool
     */
    function isProduction(): bool
    {
        return app()->environment() === 'production';
    }
}
