<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users to make this request
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Name is required, must be a string, and cannot exceed 255 characters
            'description' => 'nullable|string|max:500', // Description is optional, must be a string, and cannot exceed 500 characters
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 500 characters.',
        ];
    }
}