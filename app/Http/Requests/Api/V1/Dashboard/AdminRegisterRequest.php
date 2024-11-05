<?php

namespace App\Http\Requests\Api\V1\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255', 'unique:admins,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:255', 'in:supervisor,admin'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation/adminregister.name.required'),
            'name.string' => __('validation/adminregister.name.string'),
            'name.max' => __('validation/adminregister.name.max'),
            'username.required' => __('validation/adminregister.username.required'),
            'username.string' => __('validation/adminregister.username.string'),
            'username.max' => __('validation/adminregister.username.max'),
            'username.unique' => __('validation/adminregister.username.unique'),
            'password.required' => __('validation/adminregister.password.required'),
            'password.string' => __('validation/adminregister.password.string'),
            'password.min' => __('validation/adminregister.password.min'),
            'password.confirmed' => __('validation/adminregister.password.confirmed'),
            'role.required' => __('validation/adminregister.role.required'),
            'role.string' => __('validation/adminregister.role.string'),
            'role.max' => __('validation/adminregister.role.max'),
            'role.in' => __('validation/adminregister.role.in'),
        ];
    }
}