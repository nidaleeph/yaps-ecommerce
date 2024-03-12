<?php

namespace App\Http\Requests;

use App\Models\CategoryWatch;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryWatchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => [
                'nullable', 'exists:categories,id',
                function(string $attribute, $value, \Closure $fail) {
                    $id = $this->get('id');
                    $categoryWatch = CategoryWatch::where('id', $id)->first();

                    $children = CategoryWatch::getAllChildrenByParent($categoryWatch);
                    $ids = array_map(fn($c) => $c->id, $children);

                    if (in_array($value, $ids)) {
                        return $fail('You cannot choose [category watch] as parent which is already a child of the [category watch].');
                    }
                }
            ],
            'active' => ['required', 'boolean']
        ];
    }
}
