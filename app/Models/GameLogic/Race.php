<?php

namespace App\Models\GameLogic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
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
     * Return fighters with this race.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fighters(): HasMany
    {
        return $this->hasMany(Fighter::class, 'race_id');
    }

    /**
     * Return perks that belong to this race.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perksFor(): HasMany
    {
        return $this->hasMany(Perk::class, 'for_race_id');
    }

    /**
     * Return perks that target this race.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perksAgainst(): HasMany
    {
        return $this->hasMany(Perk::class, 'against_race_id');
    }
}
