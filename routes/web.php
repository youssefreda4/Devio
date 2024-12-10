<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\User\UserController;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/search', [PostController::class, 'search'])->name('post.search');

Route::middleware('auth')->group(function () {

    Route::get('/posts', [PostController::class, 'index'])->name('post.view');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');

    Route::resource('users', UserController::class);
    // Route::resource('users', UserController::class)->middleware('can:admin-control');
    Route::get('/users/{user}/posts', [UserController::class, 'posts'])->name('users.posts');

    Route::resource('/tags', TagController::class);
    Route::get('/tags/{tag}/posts', [TagController::class, 'posts'])->name('tags.posts');
});

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
