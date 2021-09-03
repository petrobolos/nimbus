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
    public const IMPORT_SHEET_DATA = 'Abilities';
    public const IMPORT_SHEET_PIVOT = 'Assignment';
    public const IMPORT_SHEET_EFFECTS = 'Effects';

    public const MIN_COST = 0;
    public const MAX_COST = 10;

    public const TYPE_PHYSICAL = 'physical';
    public const TYPE_SPECIAL = 'special';
    public const TYPE_RECOVERY = 'recovery';

    public const EFFECT_RECOVER_HP = 'recover_hp';
    public const EFFECT_RECOVER_SP = 'recover_sp';
    public const EFFECT_PARALYSIS = 'paralysis';
    public const EFFECT_OHKO = 'ohko';
    public const EFFECT_CRIT_CHANCE = 'crit_chance';
    public const EFFECT_HP_DRAIN = 'hp_drain';
    public const EFFECT_PURE = 'pure';

    public const SKIP = 'skip';

    public const TYPES = [
        self::TYPE_PHYSICAL,
        self::TYPE_SPECIAL,
        self::TYPE_RECOVERY,
    ];

    public const EFFECTS = [
        self::EFFECT_RECOVER_HP,
        self::EFFECT_RECOVER_SP,
        self::EFFECT_PARALYSIS,
        self::EFFECT_OHKO,
        self::EFFECT_CRIT_CHANCE,
        self::EFFECT_HP_DRAIN,
        self::EFFECT_PURE,
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
        'effects',
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
        'effects' => 'array',
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
     * Return whether this is a skip turn ability.
     *
     * @return bool
     */
    public function isSkip(): bool
    {
        return $this->code === self::SKIP;
    }
}
