<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $categories = Category::all()->map(function ($category){
            if ($category->posts()->count() > 0) {

                $data = (object)[
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'posts' => $category->posts()->latest()->take(2)->get()
                ];

                return $data;
            }
        })->whereNotNull();

        return view('home', compact('categories'));
    }
}
