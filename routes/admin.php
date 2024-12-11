<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\User\UserController;

Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
Route::get('/admin/posts/search', [PostController::class, 'search'])->name('post.search');

Route::middleware('auth')->group(function () {

    Route::get('/admin/posts', [PostController::class, 'index'])->name('post.view');
    Route::get('/admin/posts/export', [PostController::class, 'export'])->name('post.export');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/admin/posts/{post}', [PostController::class, 'show'])->name('post.show');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');

    Route::resource('/admin/users', UserController::class);
    // Route::resource('users', UserController::class)->middleware('can:admin-control');
    Route::get('/admin/users/{user}/posts', [UserController::class, 'posts'])->name('users.posts');

    Route::resource('/admin/tags', TagController::class);
    Route::get('/admin/tags/{tag}/posts', [TagController::class, 'posts'])->name('tags.posts');
});