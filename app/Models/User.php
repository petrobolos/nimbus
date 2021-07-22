<?php

namespace App\Models;

use App\Traits\Bannable;
use App\Traits\Mutable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Bannable;
    use HasFactory;
    use Mutable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'date_of_birth',
        'password',
        'preferred_locale',
        'meta',
        'last_signed_in',
        'banned_until',
        'muted_until',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'email_verified_at' => 'datetime',
        'last_signed_in' => 'datetime',
        'banned_until' => 'datetime',
        'muted_until' => 'datetime',
        'meta' => 'array',
    ];

    /**
     * A user has a single role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'key', 'role_id');
    }

    /**
     * Returns true if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role?->key === Role::ADMIN;
    }
}
