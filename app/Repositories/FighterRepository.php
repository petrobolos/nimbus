<?php

namespace App\Repositories;

use App\Models\Fighter;
use Illuminate\Support\Collection;

/**
 * Class FighterRepository
 *
 * @package App\Repositories
 */
class FighterRepository
{
    /**
     * Returns a collection of fighters from an array or collection of fighter slugs and returns a collection of
     * fighter objects. Removes nulls.
     *
     * @param array|\Illuminate\Support\Collection $roster
     * @return \Illuminate\Support\Collection
     */
    public function getFightersFromSlugRoster(array|Collection $roster): Collection
    {
        if (is_array($roster)) {
            $roster = collect($roster);
        }

        return $roster->filter()->map(function ($fighter) {
            return Fighter::where('code', $fighter)->first();
        });
    }
}
