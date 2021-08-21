<?php

namespace App\Classes\Game;

use App\Exceptions\Game\InvalidActionException;
use App\Models\Ability;
use App\Models\Fighter;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Action.
 *
 * @package App\Classes\Game
 */
class Action
{
    public const TYPE_ABILITY = 'ability';

    public const TYPE_SKIP = 'skip';

    public const TYPE_SWITCH = 'switch';

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
            self::TYPE_ABILITY => Ability::find($actionId),
            self::TYPE_SKIP => Ability::where('code', 'skip')->first(),
            self::TYPE_SWITCH => Fighter::find($actionId),
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
        } catch (Exception $exception) {
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
            return $this->model::class;
        }

        return null;
    }

    /**
     * Convert the object into the array notation used in the front-end.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'actor' => $this->actorNumber,
            'type' => $this->type,
        ];
    }
}
