<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
            'user_id' => [
                'exists:users,id',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'max:225',
            ],
            'content' => [
                'required',
            ],
            'file' => [
                'max:2099',
                'mimes:jpeg,jpg,png',
            ],
        ];
    }
}
