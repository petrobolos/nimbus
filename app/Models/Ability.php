<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ability
 *
 * @package App\Models
 */
class Ability extends Model
{
    use HasFactory;

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
}
