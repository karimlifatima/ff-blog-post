<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequestStore;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view("admin.category", compact('categories'));
    }

    public function create()
    {
        return view('admin.category-create');
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->redirectTo(route('admin.categories'));
    }

    public function show(Category $category)
    {
        $categories = (object)[
            (object)[
                'id' => $category->id,
                'slug' => $category,
                'name' => $category->name,
                "posts" => $category->posts,
            ]
        ];

        return view('home', compact('categories'));
    }

    public function edit(Category $category)
    {
        return view('admin.category-edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return response()->redirectTo(route('admin.categories'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(["id" => $category->id]);
    }
}
