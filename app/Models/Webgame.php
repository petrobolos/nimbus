<?php

namespace App\Models;

use App\Enums\GameMode;
use App\Enums\GameStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Webgame extends Model
{
    use HasFactory;

    /**
     * Determine whether the model's ID should autoincrement.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_type',
        'status',
        'player_1_id',
        'player_2_id',
        'started_at',
        'ended_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'game_type' => GameMode::class,
        'status' => GameStatus::class,
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::creating(static function (self $webgame) {
            $webgame->id = Str::uuid();
        });
    }

    /**
     * Return the master player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function first(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_1_id');
    }

    /**
     * Return the slave player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function second(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_2_id');
    }

    /**
     * Get the description for the game.
     *
     * @return string
     */
    public function getDescriptionAttribute(): string
    {
        return sprintf(
            '%svs. %s | %s',
            $this->first->playerName,
            $this->second->playerName,
            $this->game_type->pretty(),
        );
    }

    /**
     * Return the time elapsed in the current game.
     *
     * @return int
     */
    public function getTimeElapsedAttribute(): int
    {
        if ($this->status === Gamestatus::INITIALIZED) {
            return 0;
        }

        if ($this->status === GameStatus::IN_PROGRESS) {
            return Carbon::now()->diffInSeconds($this->started_at, true);
        }

        return $this->created_at->diffInSeconds($this->ended_at, true);
    }

    /**
     * Scope the query to only games that are demos.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsDemo(Builder $query): Builder
    {
        return $query->where('game_type', GameMode::DEMO->value);
    }

    /**
     * Scope the query to only games that can be started or continued.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive(Builder $query): Builder
    {
        return $query
            ->whereIn('status', GameStatus::active())
            ->whereNull('ended_at');
    }

    /**
     * Scope the query to only games that have concluded.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsInactive(Builder $query): Builder
    {
        return $query
            ->whereNotIn('status', GameStatus::active())
            ->whereNotNull('ended_at');
    }
}
