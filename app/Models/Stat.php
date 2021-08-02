<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Stat
 *
 * @package App\Models
 */
class Stat extends Model
{
    use HasFactory;

    public const RATING_BRONZE = 'bronze';
    public const RATING_SILVER = 'silver';
    public const RATING_GOLD = 'gold';
    public const RATING_PLATINUM = 'platinum';
    public const RATING_DIAMOND = 'diamond';
    public const RATING_MASTER = 'master';
    public const RATING_GRANDMASTER = 'grandmaster';

    public const RATINGS = [
        self::RATING_BRONZE => 1000,
        self::RATING_SILVER => 1100,
        self::RATING_GOLD => 1500,
        self::RATING_PLATINUM => 1800,
        self::RATING_DIAMOND => 2100,
        self::RATING_MASTER => 2400,
        self::RATING_GRANDMASTER => 2700,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'wins',
        'losses',
        'elo',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'wins' => 'integer',
        'losses' => 'integer',
        'elo' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Stats are attached to a single user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Converts the user's rating into a ranking.
     *
     * @return string
     */
    public function getRatingAttribute(): string
    {
        $rank = collect(self::RATINGS)->filter(fn (int $rating): bool => $this->elo >= $rating)->max();

        return array_search($rank, self::RATINGS, true);
    }
}
