<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Player
 *
 * @package App\Models
 */
class Player extends Model
{
    use HasFactory;

    public const FIGHTER_FIRST = 1;
    public const FIGHTER_SECOND = 2;
    public const FIGHTER_THIRD = 3;

    public const FIGHTERS = [
        self::FIGHTER_FIRST,
        self::FIGHTER_SECOND,
        self::FIGHTER_THIRD,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'fighter_id_1',
        'fighter_id_2',
        'fighter_id_3',
        'current_fighter',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'fighter_id_1' => 'integer',
        'fighter_id_2' => 'integer',
        'fighter_id_3' => 'integer',
        'current_fighter' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The relationships that should be eagerly loaded.
     *
     * @var string[]
     */
    protected $with = [
        'firstFighter',
        'secondFighter',
        'thirdFighter',
        'user',
    ];

    /**
     * Retrieve the user attached to the player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieve the first (and only necessary) fighter in the party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstFighter(): BelongsTo
    {
        return $this->belongsTo(Fighter::class, 'fighter_id_1');
    }

    /**
     * Retrieve the second fighter in the party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondFighter(): BelongsTo
    {
        return $this->belongsTo(Fighter::class, 'fighter_id_2');
    }

    /**
     * Retrieve the third fighter in the party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thirdFighter(): BelongsTo
    {
        return $this->belongsTo(Fighter::class, 'fighter_id_3');
    }

    /**
     * Return the current fighter.
     *
     * @return null|\App\Models\Fighter
     */
    public function getFighterAttribute(): ?Fighter
    {
        return match ($this->current_fighter) {
            self::FIGHTER_FIRST => $this->firstFighter,
            self::FIGHTER_SECOND => $this->secondFighter,
            self::FIGHTER_THIRD => $this->thirdFighter,
            default => null,
        };
    }

    /**
     * The player is an AI-controlled player if there's no attached user.
     *
     * @return bool
     */
    public function isCPU(): bool
    {
        return $this->user === null;
    }
}
