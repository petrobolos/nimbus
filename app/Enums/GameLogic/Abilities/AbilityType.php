<?php

namespace App\Enums\GameLogic\Abilities;

use Illuminate\Support\Str;
use Petrobolos\FixedArray\FixedArray;
use SplFixedArray;

enum AbilityType: int
{
    case SKIP = -1;
    case BLOCK = 0;
    case PHYSICAL = 1;
    case SPECIAL = 2;
    case RECOVERY = 3;

    /**
     * A description of the skip type.
     *
     * @var string
     */
    public const SKIP_DESCRIPTION = 'skip';

    /**
     * A description of the block type.
     *
     * @var string
     */
    public const BLOCK_DESCRIPTION = 'block';

    /**
     * A description of the physical type.
     *
     * @var string
     */
    public const PHYSICAL_DESCRIPTION = 'physical';

    /**
     * A description of the special type.
     *
     * @var string
     */
    public const SPECIAL_DESCRIPTION = 'special';

    /**
     * A description of the recovery type.
     *
     * @var string
     */
    public const RECOVERY_DESCRIPTION = 'recovery';

    /**
     * An array of type descriptions.
     *
     * @var array
     */
    public const TYPE_DESCRIPTIONS = [
        self::SKIP_DESCRIPTION,
        self::BLOCK_DESCRIPTION,
        self::PHYSICAL_DESCRIPTION,
        self::SPECIAL_DESCRIPTION,
        self::RECOVERY_DESCRIPTION,
    ];

    /**
     * Return the types of ability.
     *
     * @return \SplFixedArray
     */
    public static function types(): SplFixedArray
    {
        return FixedArray::fromArray(self::cases());
    }

    /**
     * Get the ability type value from a string interpretation.
     *
     * @param string $name
     * @return int
     */
    public static function fromPretty(string $name): int
    {
        return match (Str::lower($name)) {
            self::SKIP_DESCRIPTION => self::SKIP->value,
            self::BLOCK_DESCRIPTION => self::BLOCK->value,
            self::PHYSICAL_DESCRIPTION => self::PHYSICAL->value,
            self::SPECIAL_DESCRIPTION => self::SPECIAL->value,
            self::RECOVERY_DESCRIPTION => self::RECOVERY->value,
            default => self::default(),
        };
    }

    /**
     * Return the default ability type.
     *
     * @return int
     */
    public static function default(): int
    {
        return self::SKIP->value;
    }
}
