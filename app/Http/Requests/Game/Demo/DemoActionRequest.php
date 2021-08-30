<?php

namespace App\Http\Requests\Game\Demo;

use App\Classes\Game\Action;
use App\Rules\Game\Demo\DemoGameActiveInSessionRule;
use App\Rules\Game\Demo\DemoGameExistsRule;
use App\Rules\Game\InProgressRule;
use App\Rules\Game\ValidActionRule;
use App\Rules\Game\ValidPlayerNumberRule;
use App\Rules\Game\ValidStateHistoryRule;
use App\Support\RegularExpressions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class DemoActionRequest
 *
 * @package App\Http\Requests\Game\Demo
 */
class DemoActionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'game_id' => [
                'required',
                'bail',
                'integer',
                new DemoGameActiveInSessionRule(),
                new DemoGameExistsRule(),
                new InProgressRule(),
            ],

            'state_hash' => [
                'required',
                'bail',
                'string',
                'regex:' . RegularExpressions::VALID_BCRYPT_HASH,
                new ValidStateHistoryRule(),
            ],

            'action' => [
                'required',
                'bail',
                'array',
                new ValidActionRule(),
            ],

            'action.id' => [
                'required',
                'integer',
            ],

            'action.actor' => [
                'required',
                'integer',
                new ValidPlayerNumberRule(),
            ],

            'action.type' => [
                'required',
                'string',
                Rule::in(Action::TYPES),
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
