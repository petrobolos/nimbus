<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    public const PLAYER = 1;
    public const PREMIUM_PLAYER = 2;
    public const ADMIN = 3;

    public const ROLES = [
        self::PLAYER => [
            'name' => 'Player',
            'description' => 'A free-to-play player.',
        ],
        self::PREMIUM_PLAYER => [
            'name' => 'Premium Player',
            'description' =>  'A player who has joined the premium play mode.',
        ],
        self::ADMIN => [
            'name' => 'Administrator',
            'description' => 'An administrator user.',
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'key',
        'name',
        'description',
    ];

    /**
     * A role belongs to numerous users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
