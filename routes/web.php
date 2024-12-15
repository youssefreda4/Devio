<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Home\HomeController;
use App\Http\Controllers\Front\Post\PostController;
use App\Http\Controllers\Front\About\AboutController;
use App\Http\Controllers\Front\Contact\ContactController;
use App\Http\Controllers\Front\Profile\ProfileController;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('front.home');

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('front.posts');
    Route::get('/posts/search', 'search')->name('front.posts.search');
    Route::get('/posts/{post}/show', 'show')->name('front.posts.show');
    Route::get('/posts/{tag}/tag-posts', 'postsTag')->name('front.posts.showPostsTag');

    Route::middleware('writer.area', 'auth')->group(function () {
        Route::get('/posts/create', 'create')->name('front.posts.create');
        Route::post('/posts', 'store')->name('front.posts.store');
        Route::get('/posts/{post}/edit', 'edit')->name('front.posts.edit');
        Route::put('/posts/{post}', 'update')->name('front.posts.update');
        Route::post('/posts/{post}', 'likedStore')->name('front.posts.likedstore');
        Route::post('/posts/{post}/storecomment', 'storeComment')->name('front.posts.storecomment');
        Route::get('/posts/{notification}', 'markAsRead')->name('front.posts.markAsRead');
        Route::delete('/posts/{comment}/destroy', 'commentDestroy')->name('front.posts.commentDestroy');
        Route::delete('/posts/{post}', 'destroy')->name('front.posts.destroy');
    });
});

Route::middleware('writer.area', 'auth')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('front.profile');
            Route::get('/profile/{user}/edit', 'edit')->name('front.profile.edit');
            Route::put('/profile/{user}', 'update')->name('front.profile.update');
            Route::get('/profile/{user}/show', 'show')->name('front.profile.show');
        });
    });
});

Route::get('/about', [AboutController::class, 'index'])->name('front.about');

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('front.contact');
    Route::post('/contact', 'store')->name('front.contact.store');
});

require_once(__DIR__ . '/admin.php');
