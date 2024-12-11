<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Home\HomeController;
use App\Http\Controllers\Front\Post\PostController;
use App\Http\Controllers\Front\About\AboutController;
use App\Http\Controllers\Front\Contact\ContactController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/posts', [PostController::class, 'index'])->name('front.posts');
Route::get('/posts/search', [PostController::class, 'search'])->name('front.posts.search');
Route::get('/about', [AboutController::class, 'index'])->name('front.about');

Route::get('/contact', [ContactController::class, 'index'])->name('front.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('front.contact.store');




require_once(__DIR__ . '/admin.php');

