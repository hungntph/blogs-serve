<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
                'unique:users,name,'.$this->id. ',id',
                'max:225',
                'regex:/^[a-z0-9]+$/',
            ],
            'phone' => [
                'max:11',
                'nullable',
                'regex:/^[0-9]+$/',
            ],
            'file' => [
                'max:2000',
                'mimes:jpeg,jpg,png',
            ],
        ];
    }
}
