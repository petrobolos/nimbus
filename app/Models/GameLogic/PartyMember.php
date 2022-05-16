<?php

namespace App\Models\GameLogic;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PartyMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fighter_id',
        'is_paralyzed',
        'hp',
        'sp',
        'attack',
        'defense',
        'speed',
        'special',
        'spirit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * A party member belongs to a fighter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fighter(): BelongsTo
    {
        return $this->belongsTo(Fighter::class);
    }

    /**
     * A party member has a player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player(): HasOne
    {
        return $this->hasOne(Player::class);
    }
}
