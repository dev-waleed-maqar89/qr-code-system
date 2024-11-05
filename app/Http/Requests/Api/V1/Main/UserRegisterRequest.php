<?php

namespace App\Http\Requests\Api\V1\Main;

use App\Rules\SpecificStartAndLength;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', new SpecificStartAndLength(9, [5])],
            'identity' => ['required', new SpecificStartAndLength(10, [1, 2])],
            'birth_date' => ['required', 'date'],
            'parent_email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation/userregister.name.required'),
            'name.string' => __('validation/userregister.name.string'),
            'name.max' => __('validation/userregister.name.max'),
            'email.required' => __('validation/userregister.email.required'),
            'email.string' => __('validation/userregister.email.string'),
            'email.email' => __('validation/userregister.email.email'),
            'email.max' => __('validation/userregister.email.max'),
            'email.unique' => __('validation/userregister.email.unique'),
            'phone.required' => __('validation/userregister.phone.required'),
            'identity.required' => __('validation/userregister.identity.required'),
            'birth_date.required' => __('validation/userregister.birth_date.required'),
            'birth_date.date' => __('validation/userregister.birth_date.date'),
            'parent_email.required' => __('validation/userregister.parent_email.required'),
            'parent_email.string' => __('validation/userregister.parent_email.string'),
            'parent_email.email' => __('validation/userregister.parent_email.email'),
            'parent_email.max' => __('validation/userregister.parent_email.max'),
            'password.required' => __('validation/userregister.password.required'),
            'password.string' => __('validation/userregister.password.string'),
            'password.min' => __('validation/userregister.password.min'),
            'password.confirmed' => __('validation/userregister.password.confirmed'),
        ];
    }
}