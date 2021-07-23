<?php

namespace App\Models;

use App\Models\Pivots\FighterAbility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Ability
 *
 * @package App\Models
 */
class Ability extends Model
{
    use HasFactory;

    public const IMPORT_SHEET = 'game/Abilities.xlsx';

    public const MIN_COST = 0;
    public const MAX_COST = 10;

    public const TYPE_PHYSICAL = 'physical';
    public const TYPE_SPECIAL = 'special';
    public const TYPE_RECOVERY = 'recovery';

    public const TYPES = [
        self::TYPE_PHYSICAL,
        self::TYPE_SPECIAL,
        self::TYPE_RECOVERY
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'cost',
        'type',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cost' => 'integer',
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
}
