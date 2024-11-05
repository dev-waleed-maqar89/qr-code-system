<?php

namespace App\Http\Requests\Api\V1\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PaperCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'max_score' => ['required', 'numeric', 'min:0', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __('validation/papercreate.title.required'),
            'title.string' => __('validation/papercreate.title.string'),
            'title.max' => __('validation/papercreate.title.max'),
            'max_score.required' => __('validation/papercreate.max_score.required'),
            'max_score.numeric' => __('validation/papercreate.max_score.numeric'),
            'max_score.min' => __('validation/papercreate.max_score.min'),
            'max_score.max' => __('validation/papercreate.max_score.max'),
        ];
    }
}