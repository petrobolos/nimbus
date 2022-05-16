<?php

namespace App\Models\GameLogic;

use App\Enums\GameLogic\Perks\PerkType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perk extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'for_race_id',
        'against_race_id',
        'type',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'type' => PerkType::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * A perk has a race that it is for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function for(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'for_race_id');
    }

    /**
     * A perk has a race that it is against.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function against(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'against_race_id');
    }
}
