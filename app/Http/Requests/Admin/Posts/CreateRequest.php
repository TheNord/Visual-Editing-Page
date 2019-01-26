<?php

namespace App\Http\Requests\Admin\Posts;

use App\Entity\Post\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'content' => 'required',
            'category' => 'required',
            'status' => ['required', 'string', 'max:255', Rule::in(array_keys(Post::statusList()))],
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
        ];
    }
}