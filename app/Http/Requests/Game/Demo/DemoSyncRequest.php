<?php

namespace App\Http\Requests\Game\Demo;

use App\Rules\Game\ValidPlayerNumberRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DemoSyncRequest.
 *
 * @package App\Http\Requests\Game\Demo
 */
class DemoSyncRequest extends FormRequest
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
                'integer',

            ],

            'state' => [
                'required',
                'bail',
                'array',
            ],

            'state.history' => [
                'required',
                'array',
            ],

            'state.currentPlayer' => [
                'required',
                'integer',
                new ValidPlayerNumberRule(),
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
        return true;
    }
}
