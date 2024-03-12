<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class WatchRequest extends FormRequest
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
            'watch_code' => ['required', 'max:2000'],
            'images.*' => ['nullable', 'image'],
            'deleted_images.*' => ['nullable', 'int'],
            'image_positions.*' => ['nullable', 'int'],
            'description' => ['nullable', 'string'],
            'subtitle' => ['nullable', 'string'],
            'url' => ['required', 'max:2000'],
            'published' => ['required', 'boolean'],
            // 'categories' => ['required', 'array', Rule::exists('categories', 'id')],
            'categories' => ['required', Rule::exists('category_watches', 'id')],
        ];
    }

    public function messages()
    {
        return [
            'categories.required' => 'At least one [watch category] is required.',
        ];
    }
}
