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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
}