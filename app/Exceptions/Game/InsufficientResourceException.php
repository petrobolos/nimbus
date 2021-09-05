<?php

namespace App\Exceptions\Game;

use Exception;

/**
 * Class InsufficientResourceException
 *
 * @package App\Exceptions
 */
class InsufficientResourceException extends Exception
{
    protected $message = 'There is not enough SP (or HP) for this move.';

    protected $code = 422;
}
