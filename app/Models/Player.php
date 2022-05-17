<?php

namespace App\Models;

use App\Models\GameLogic\PartyMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Player extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'party_member_id_1',
        'party_member_id_2',
        'party_member_id_3',
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
     * A player belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the first member of this player's party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function first(): BelongsTo
    {
        return $this->belongsTo(PartyMember::class, 'party_member_id_1');
    }

    /**
     * Return the second member of this player's party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function second(): BelongsTo
    {
        return $this->belongsTo(PartyMember::class, 'party_member_id_2');
    }

    /**
     * Return the third member of this player's party.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function third(): BelongsTo
    {
        return $this->belongsTo(PartyMember::class, 'party_member_id_3');
    }

    /**
     * Return the player's display name.
     *
     * @return string
     */
    public function getPlayerNameAttribute(): string
    {
        if ($this->is_cpu) {
            return config('nimbus.webgame.default_cpu_name', 'CPU');
        }

        return $this->user->username ?? config('nimbus.webgame.default_player_name', 'Guest');
    }

    /**
     * Return whether the current player is a CPU-controlled entity.
     *
     * @return bool
     */
    public function getIsCpuAttribute(): bool
    {
        return $this->user_id === null;
    }

    /**
     * Return the current party member for this player.
     *
     * @return null|\App\Models\GameLogic\PartyMember
     */
    public function current(): ?PartyMember
    {
        return match ($this->current_party_member_id) {
            1 => $this->first,
            2 => $this->second,
            3 => $this->third,
            default => null,
        };
    }

    /**
     * Return the party members.
     *
     * @return \Illuminate\Support\Collection
     */
    public function party(): Collection
    {
        return collect([
            $this->first(),
            $this->second(),
            $this->third(),
        ]);
    }
}
