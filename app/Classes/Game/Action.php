<?php

namespace App\Classes\Game;

use App\Exceptions\Game\InvalidActionException;
use App\Models\Ability;
use App\Models\Fighter;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Action.
 *
 * @package App\Classes\Game
 */
class Action
{
    public int $actorNumber;

    public int $id;

    public string $type;

    public ?Model $model;

    /**
     * Action constructor.
     *
     * @param int $actorNumber
     * @param int $actionId
     * @param string $actionType
     * @throws \App\Exceptions\Game\InvalidActionException
     */
    public function __construct(int $actorNumber, int $actionId, string $actionType)
    {
        $this->actorNumber = $actorNumber;
        $this->id = $actionId;
        $this->type = $actionType;

        $this->model = match ($actionType) {
            'ability' => Ability::find($actionId),
            'skip' => Ability::where('code', 'skip')->first(),
            'switch' => Fighter::find($actionId),
            default => null,
        };

        if ($this->model === null) {
            throw new InvalidActionException();
        }
    }

    /**
     * Convert an array of actions (such as those in a request) to an array of action objects.
     *
     * @param array $actions
     * @return array
     */
    public static function convert(array $actions): array
    {
        try {
            return array_map(
                static fn (array $action): Action => new self($action['actor'], $action['id'], $action['type']),
                $actions
            );
        } catch (InvalidActionException $exception) {
            report($exception);
        }

        return [];
    }

    /**
     * Return what type the action is.
     *
     * @return null|string
     */
    public function type(): ?string
    {
        if (is_object($this->model)) {
            return $this->model;
        }

        return null;
    }
}
