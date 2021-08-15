<?php

namespace App\Http\Requests\Game\Demo;

use App\Enums\Heartbeat;
use App\Rules\Game\Demo\DemoGameActiveInSessionRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class DemoHeartbeatRequest.
 *
 * @package App\Http\Requests\Game\Demo
 */
class DemoHeartbeatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'gameId' => [
                'required',
                'bail',
                'integer',
                new DemoGameActiveInSessionRule(),
            ],

            'heartbeat' => [
                'required',
                'string',
                Rule::in([Heartbeat::DEMO]),
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }
}
