<?php

namespace App\Http\Requests\CommodityCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommodityCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:commodity_categories,name'],
            'description' => ['nullable', 'string'],
        ];
    }
}