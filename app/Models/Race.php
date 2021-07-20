<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Race
 *
 * @package App\Models
 */
class Race extends Model
{
    use HasFactory;

    public const RACE_HUMAN = 'human';
    public const RACE_SAIYAN = 'saiyan';
    public const RACE_SAIYAN_GOD = 'saiyan_god';
    public const RACE_NAMEKIAN = 'namek';
    public const RACE_ANDROID = 'android';
    public const RACE_DEMON = 'demon';
    public const RACE_MAJIN = 'majin';
    public const RACE_FRIEZA = 'frieza';
    public const RACE_GOD_OF_DESTRUCTION = 'god_of_destruction';

    public const RACES = [
        self::RACE_HUMAN,
        self::RACE_SAIYAN,
        self::RACE_SAIYAN_GOD,
        self::RACE_NAMEKIAN,
        self::RACE_ANDROID,
        self::RACE_DEMON,
        self::RACE_MAJIN,
        self::RACE_FRIEZA,
        self::RACE_GOD_OF_DESTRUCTION,
    ];
}
