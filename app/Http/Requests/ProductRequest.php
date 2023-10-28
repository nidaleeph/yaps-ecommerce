<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:2000'],
            'product_code' => ['required', 'max:2000'],
            'images.*' => ['nullable', 'image'],
            'deleted_images.*' => ['nullable', 'int'],
            'image_positions.*' => ['nullable', 'int'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'description' => ['nullable', 'string'],
            'published' => ['required', 'boolean'],
            // 'categories' => ['required', 'array', Rule::exists('categories', 'id')],
            'categories' => ['required', Rule::exists('categories', 'id')],
        ];
    }

    public function messages()
    {
        return [
            'categories.required' => 'At least one category is required.',
        ];
    }
}
