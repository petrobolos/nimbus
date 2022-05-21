<?php

namespace App\Models\GameLogic;

use App\Enums\GameLogic\Abilities\AbilityEffect;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Effect extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ability',
        'ability_id',
        'value',
        'is_boolean',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'ability' => AbilityEffect::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * An effect is inflicted by an ability.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ability(): BelongsTo
    {
        return $this->belongsTo(Ability::class);
    }

    /**
     * Cast the value property to an integer or boolean according to its type.
     *
     * @return bool|int
     */
    public function getValueAttribute(): bool|int
    {
        if ($this->is_boolean) {
            return (bool) $this->value;
        }

        return $this->value;
    }
}
