<?php

namespace App\Support;

abstract class RegularExpressions
{
    public const VALID_BCRYPT_HASH = '^\$2[ayb]\$.{56}$^';

    public const VALID_UUID = '/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i';
}
