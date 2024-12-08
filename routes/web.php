<?php

use App\Http\Controllers\Front\Home\HomeController;
use App\Http\Controllers\Front\Post\PostController;
use App\Http\Controllers\Front\Tag\TagController;
use App\Http\Controllers\Front\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('post.view');
Route::get('/posts/search', [PostController::class, 'search'])->name('post.search');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');


Route::resource('users', UserController::class);
Route::get('/users/{user}/posts', [UserController::class,'posts'])->name('users.posts');

Route::resource('/tags',TagController::class);
Route::get('/tags/{tag}/posts', [TagController::class,'posts'])->name('tags.posts');