<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class FighterAbility
 *
 * @package App\Models\Pivots
 */
class FighterAbility extends Pivot
{
    use HasFactory;

    protected $table = 'fighter_abilities';
}
