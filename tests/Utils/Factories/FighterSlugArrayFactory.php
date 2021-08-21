<?php

namespace Tests\Utils\Factories;

use App\Models\Fighter;

/**
 * Class FighterSlugArrayFactory
 *
 * @package Tests\Utils\Factories
 */
final class FighterSlugArrayFactory
{
    /**
     * Return an array of fighter codes.
     *
     * @return string[]
     */
    public static function factory(): array
    {
        return [
            Fighter::inRandomOrder()->first()->code,
            Fighter::inRandomOrder()->first()->code,
            Fighter::inRandomOrder()->first()->code,
        ];
    }
}
