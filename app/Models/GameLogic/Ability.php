<?php

namespace App\Models\GameLogic;

use App\Enums\GameLogic\Abilities\AbilityType;
use App\Models\GameLogic\Pivots\FighterAbility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ability extends Model
{
    use HasFactory;

    /**
     * The maximum amount of SP (or HP) an ability can cost.
     *
     * @var int
     */
    public const MAX_COST = 100;

    /**
     * The minimum amount of SP (or HP) an ability can cost.
     *
     * @var int
     */
    public const MIN_COST = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_universal',
        'cost',
        'type',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'type' => AbilityType::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * An ability belongs to many fighters.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fighters(): BelongsToMany
    {
        return $this
            ->belongsToMany(Fighter::class, FighterAbility::class)
            ->withPivot('fighter_id', 'ability_id')
            ->as(__FUNCTION__)
            ->withTimestamps();
    }

    /**
     * An ability has many effects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function effects(): HasMany
    {
        return $this->hasMany(Effect::class);
    }
}
