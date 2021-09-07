<?php

namespace App\Exceptions\Game;

use Exception;

/**
 * Class InvalidFighterSwitchException
 *
 * @package App\Exceptions\Game
 */
class InvalidFighterSwitchException extends Exception
{
    protected $message = 'The player does not have this fighter in their party';

    protected $code = 422;
}
