<?php

namespace App\Exceptions\Game;

use Exception;

/**
 * Class InvalidActionException.
 *
 * @mixin \App\Classes\Game\Action
 * @package App\Exceptions
 */
class InvalidActionException extends Exception
{
    protected $message = 'The action specified is not a valid action.';

    protected $code = 422;

    /**
     * Get the exception's context information.
     *
     * @return array
     */
    public function context(): array
    {
        return [
            'action' => $this->action ?? null,
        ];
    }
}
