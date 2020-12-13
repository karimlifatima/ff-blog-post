<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($this->post),
            ],
            "content" => 'required',
            'photo' => 'file|mimes:jpg,png,jpeg|max:204800',
            "editors_choice" => '',
            "categories" => 'required',
        ];
    }
}
