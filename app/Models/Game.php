<?php

namespace App\Models;

use App\Classes\Game\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use JsonException;

/**
 * Class Game.
 *
 * @package App\Models
 */
class Game extends Model
{
    use HasFactory;

    use SoftDeletes;

    public const REGEX_FOR_BCRYPT_GAME_HASHES = '^\$2[ayb]\$.{56}$^';

    public const STATUS_IN_PROGRESS = 'in-progress';

    public const STATUS_CONCLUDED = 'concluded';

    public const STATUS_ABANDONED = 'abandoned';

    public const STATUSES = [
        self::STATUS_IN_PROGRESS,
        self::STATUS_CONCLUDED,
        self::STATUS_ABANDONED,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_1',
        'player_2',
        'status',
        'ranked',
        'against_ai',
        'state',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'player_1' => 'integer',
        'player_2' => 'integer',
        'ranked' => 'boolean',
        'against_ai' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'state' => State::class,
    ];

    /**
     * Attributes to include in the serialisations of this model.
     *
     * @var string[]
     */
    protected $appends = [
        'time_elapsed',
    ];

    /**
     * The relationships that should be eagerly loaded.
     *
     * @var string[]
     */
    protected $with = [
        'firstPlayer',
        'secondPlayer',
    ];

    /**
     * Get the first player of the match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_1');
    }

    /**
     * Get the second player of the match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_2');
    }

    /**
     * Get time elapsed for the current game.
     *
     * @return int
     */
    public function getTimeElapsedAttribute(): int
    {
        if ($this->inProgress()) {
            return now()->diffInSeconds($this->created_at);
        }

        return $this->updated_at->diffInSeconds($this->created_at);
    }

    /**
     * Get the hash for the state JSON.
     *
     * @throws JsonException
     * @return string
     */
    public function getStateHashAttribute(): string
    {
        return createArrayHash($this->state->toArray());
    }

    /**
     * Return whether this game is in-progress.
     *
     * @return bool
     */
    public function inProgress(): bool
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    /**
     * Return whether this game has been abandoned.
     *
     * @return bool
     */
    public function abandoned(): bool
    {
        return $this->status === self::STATUS_ABANDONED;
    }

    /**
     * Return whether this game has been concluded.
     *
     * @return bool
     */
    public function concluded(): bool
    {
        return $this->status === self::STATUS_CONCLUDED;
    }
}
