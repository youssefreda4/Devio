<?php

namespace App\Http\Controllers\Front\Home;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('id', 'DESC')->limit(6)->get();
        return view('Front.pages.home.index', compact('posts'));
    }
}
