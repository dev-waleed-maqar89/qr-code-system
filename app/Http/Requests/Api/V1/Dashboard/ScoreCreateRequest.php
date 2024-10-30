<?php

namespace App\Http\Requests\Api\V1\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ScoreCreateRequest extends FormRequest
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
            'paper_id' => ['required', 'exists:papers,id'],
            'user_id' => ['required', 'exists:users,id'],
            'admin_id' => ['required', 'exists:admins,id'],
            'score' => ['required', 'numeric'],
        ];
    }
}