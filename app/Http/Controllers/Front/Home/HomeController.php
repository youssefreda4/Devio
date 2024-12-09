<?php

namespace App\Http\Controllers\Front\Home;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(8);
        return view('front.pages.home.index', compact('posts'));
    }
}
