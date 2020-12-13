<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class EditorsChoiceController extends Controller
{
    public function index()
    {
        $categories = Category::all()->map(function ($category){
            if ($category->posts()->where('editors_choice', true)->exists()) {

                $data = (object)[
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'posts' => $category->posts()->where('editors_choice', true)->get()
                ];

                return $data;
            }
        })->whereNotNull();

        return view('home', compact('categories'));
    }
}
