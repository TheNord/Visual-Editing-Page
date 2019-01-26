<?php

namespace App\Http\Requests\Admin\Menus;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'page_id' => 'nullable|integer|exists:pages,id',
            'category_id' => 'nullable|integer|exists:posts_categories,id',
            'parent_id' => 'nullable|integer|exists:menu,id',
        ];
    }
}