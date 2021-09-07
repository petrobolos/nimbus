<?php

namespace App\Exceptions\Game;

use Exception;

/**
 * Class FighterIsDefeatedException
 *
 * @package App\Exceptions\Game
 */
class FighterIsDefeatedException extends Exception
{
    protected $message = 'The fighter has no HP and is unable to fight!';

    protected $code = 422;
}
