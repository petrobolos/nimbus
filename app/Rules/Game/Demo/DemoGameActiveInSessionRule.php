<?php

namespace App\Rules\Game\Demo;

use App\Services\DemoService;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class DemoGameActiveInSessionRule.
 *
 * @package App\Rules\Game\Demo
 */
class DemoGameActiveInSessionRule implements Rule
{
    protected DemoService $demoService;

    /**
     * DemoGameActiveInSessionRule constructor.
     */
    public function __construct()
    {
        $this->demoService = app(DemoService::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param int $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->demoService->getDemoGame() === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The game ID found in session is not correct.';
    }
}
