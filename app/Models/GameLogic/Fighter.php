<?php

namespace App\Models\GameLogic;

use App\Actions\GameLogic\Abilities\AssignUniversalAbilities;
use App\Models\GameLogic\Pivots\FighterAbility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fighter extends Model
{
    use HasFactory;

    /**
     * The minimum value that a stat can be.
     *
     * @var int
     */
    public const STAT_MIN = 0;

    /**
     * The maximum value that a stat can be.
     *
     * @var int
     */
    public const STAT_MAX = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'race_id',
        'base_hp',
        'base_sp',
        'base_attack',
        'base_defense',
        'base_speed',
        'base_special',
        'base_spirit',
        'last_form_id',
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
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::created(static function (self $fighter) {
            app(AssignUniversalAbilities::class)->execute($fighter);
        });
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
}
