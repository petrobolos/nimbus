<?php

namespace App\Models;

use App\Models\Pivots\FighterAbility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class Fighter.
 *
 * @package App\Models
 */
class Fighter extends Model
{
    use HasFactory;

    public const IMPORT_SHEET = 'game/Fighters.xlsx';

    public const HEALTH_MAX = 100;

    public const HEALTH_MIN = 0;

    public const SP_MAX = 100;

    public const SP_MIN = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'race_id',
        'is_boss',
        'is_paralyzed',
        'current_hp',
        'current_sp',
        'last_form_id',
        'hp',
        'sp',
        'attack',
        'defense',
        'speed',
        'special',
        'spirit',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_paralyzed' => 'boolean',
        'is_boss' => 'boolean',
        'current_hp' => 'integer',
        'current_sp' => 'integer',
        'hp' => 'integer',
        'sp' => 'integer',
        'attack' => 'integer',
        'defense' => 'integer',
        'speed' => 'integer',
        'special' => 'integer',
        'spirit' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The relationships that should be eagerly loaded.
     *
     * @var string[]
     */
    protected $with = [
        'abilities',
    ];

    /**
     * Generate a UUID for a particular fighter instance. Mainly used client side.
     *
     * @return string
     */
    public function getUuidAttribute(): string
    {
        return Str::uuid();
    }

    /**
     * Return total fighter HP.
     *
     * @return int
     */
    public function getTotalHpAttribute(): int
    {
        return self::HEALTH_MAX + $this->hp;
    }

    /**
     * Return total fighter SP.
     *
     * @return int
     */
    public function getTotalSpAttribute(): int
    {
        return self::SP_MAX + $this->sp;
    }

    /**
     * Is this fighter a boss fighter, with the defense amplifiers?
     *
     * @return bool
     */
    public function isBoss(): bool
    {
        return $this->is_boss;
    }

    /**
     * Does this fighter's race have an immunity against the incoming damage type?
     *
     * @param \App\Models\Race $enemyRace
     * @param \App\Models\Ability $ability
     * @return bool
     */
    public function isImmuneToAbility(Race $enemyRace, Ability $ability): bool
    {
        return ($ability->type === Ability::TYPE_PHYSICAL && $this->compareRace($enemyRace, Perk::TYPE_PHYSICAL_IMMUNITY)) ||
            ($ability->type === Ability::TYPE_SPECIAL && $this->compareRace($enemyRace, Perk::TYPE_SPECIAL_IMMUNITY));
    }

    /**
     * Returns whether this fighter has enough resource to cast this ability.
     *
     * @param \App\Models\Ability $ability
     * @return bool
     */
    public function hasEnoughResource(Ability $ability): bool
    {
        if ($ability->cost === 0) {
            return true;
        }

        if ($ability->effects[Ability::EFFECT_HP_DRAIN]) {
            return $ability->cost > $this->current_hp && ($this->current_hp - $ability->cost) > 0;
        }

        return $ability->cost > $this->current_sp;
    }

    /**
     * Check the perks of this fighter against the race of the enemy.
     *
     * @param \App\Models\Race $enemyRace
     * @param string $perkType
     * @return bool
     */
    public function compareRace(Race $enemyRace, string $perkType): bool
    {
        return Perk::where([
            ['for_race', '=', $this->race],
            ['against_race', '=', $enemyRace],
            ['type', '=', $perkType],
        ])->exists();
    }

    /**
     * A fighter will belong to many abilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function abilities(): BelongsToMany
    {
        return $this
            ->belongsToMany(Ability::class, FighterAbility::class)
            ->withPivot('fighter_id', 'ability_id')
            ->as(__FUNCTION__)
            ->withTimestamps();
    }

    /**
     * A fighter belongs to a single race.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    /**
     * A fighter has a single previous form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastForm(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'last_form_id');
    }

    /**
     * A fighter can have multiple next forms.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nextForms(): HasMany
    {
        return $this->hasMany(__CLASS__, 'last_form_id');
    }

    /**
     * Returns the entire form tree of a given fighter, starting at its most base form.
     *
     * FIXME: Fix these methods.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllForms(): Collection
    {
        $currentNode = $this;

        do {
            $currentNode = $currentNode->lastForm;
        } while ($currentNode->lastForm !== null);

        return collect($this->traverseNodesForForms($currentNode));
    }

    /**
     * Traverse recursively through the forms of fighters to build a structured collection of fighter objects.
     *
     * @param \App\Models\Fighter $currentFighter
     * @return array
     */
    private function traverseNodesForForms(self $currentFighter): array
    {
        $fighters = [];

        if ($currentFighter->nextForms->count() !== 0) {
            foreach ($currentFighter->nextForms as $fighterForm) {
                /** @var \App\Models\Fighter $fighterForm */
                $fighters[$fighterForm->code] = $fighterForm->withoutRelations();
                $fighters[$fighterForm->code]['forms'] = $this->traverseNodesForForms($fighterForm);
            }
        }

        return $fighters;
    }
}
