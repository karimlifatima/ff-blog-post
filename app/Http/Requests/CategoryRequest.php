<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique('categories')->ignore($this->category),
            ],
            'description' => 'required'
        ];
    }
}
