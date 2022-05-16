<?php

namespace App\Models\GameLogic\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FighterAbility extends Pivot
{
    use HasFactory;

    /**
     * A custom table name that is associated with this pivot model.
     *
     * @var string
     */
    protected $table = 'fighter_abilities';
}
