<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => [
                'required',
                'unique:users,name',
                'max:225',
                'regex:/^[a-z0-9]+$/',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'max:225',
            ],
            'password' => [
                'required',
                'min:6',
                'max:20',
                'confirmed',
            ],
        ];
    }
}
