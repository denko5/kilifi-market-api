<?php

namespace App\Http\Requests\CommodityCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommodityCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('commodity_categories', 'name')->ignore($this->route('commodity_category')),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}