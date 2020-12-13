<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditorsChoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/editors-choice', [EditorsChoiceController::class, 'index'])->name('editorsChoice');



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->withoutMiddleware('auth');
    Route::post('login', [LoginController::class, 'login'])->withoutMiddleware('auth');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function (){
        return view("admin.dashboard");
    })->name('dashboard');

    Route::get('/post', [PostController::class, 'indexAdmin'])->name('post');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post:slug}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post:slug}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category:slug}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

});
