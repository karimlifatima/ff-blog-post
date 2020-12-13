<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequestStore;
use App\Http\Requests\BlogPostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all()->map(function ($category){
            if ($category->posts()->count() > 0) {

                $data = (object)[
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'posts' => $category->posts
                ];

                return $data;
            }
        })->whereNotNull();

        return view('home', compact('categories'));
    }

    public function indexAdmin () {
        $posts = Post::all()->map(function ($post) {
            $post->categories = $post->categories->pluck('name')->implode(', ');
            return $post;
        });


        return view("admin.post", compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.post-create', compact('categories'));
    }

    public function store(BlogPostRequest $request)
    {
        $validated = $request->validated();

        if ($request->has('photo')) {
            $photoName = time() . '-' . request('photo')->getClientOriginalName();
            request('photo')->storeAs('public/blog-photos', $photoName);
            $validated['photo'] = $photoName;
        }

        $post = Post::create(Arr::except($validated, 'categories') );

        $post->categories()->attach($validated["categories"]);

        return response()->redirectTo(route('admin.post'));
    }

    public function show(Post $post)
    {
        return view('post', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.post-edit', compact('post', 'categories'));
    }

    public function update(BlogPostRequest $request, Post $post)
    {
        $validated = $request->validated();

        if ($request->has('photo')) {
            $photoName = time() . '-' . request('photo')->getClientOriginalName();
            request('photo')->storeAs('public/blog-photos', $photoName);
            $validated['photo'] = $photoName;
        }

        $validated['editors_choice'] = $request->has('editors_choice') ? 1 : 0;

        $post->update(Arr::except($validated, 'categories') );

        $post->categories()->sync($validated["categories"]);

        return response()->redirectTo(route('admin.post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(["id"=>$post->id]);
    }
}
