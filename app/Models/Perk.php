<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perk extends Model
{
    use HasFactory;

    public const TYPE_WEAKNESS = 'weakness';
    public const TYPE_RESISTANCE = 'resistance';
    public const TYPE_SUPER_EFFECTIVE = 'super_effective';
    public const TYPE_INEFFECTIVE = 'ineffective';
    public const TYPE_PHYSICAL_IMMUNITY = 'physical_immunity';
    public const TYPE_SPECIAL_IMMUNITY = 'special_immunity';

    public const TYPES = [
        self::TYPE_WEAKNESS,
        self::TYPE_RESISTANCE,
        self::TYPE_SUPER_EFFECTIVE,
        self::TYPE_INEFFECTIVE,
        self::TYPE_PHYSICAL_IMMUNITY,
        self::TYPE_SPECIAL_IMMUNITY,
    ];
}