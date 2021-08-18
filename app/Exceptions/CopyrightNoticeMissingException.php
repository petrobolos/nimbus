<?php

namespace App\Exceptions;

use Exception;

/**
 * Class CopyrightNoticeMissingException.
 *
 * @package App\Exceptions
 */
class CopyrightNoticeMissingException extends Exception
{
    protected $line = 'The game will not function without the copyright notice in place.';

    protected $code = 503;
}
