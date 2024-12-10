<?php

namespace App\Http\Controllers\Admin\Home;

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
        $posts = Post::with('user')->orderBy('id', 'DESC')->paginate(8);
        return view('Admin.pages.home.index', compact('posts'));
    }
}
