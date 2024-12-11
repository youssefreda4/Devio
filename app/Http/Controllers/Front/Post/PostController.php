<?php

namespace App\Http\Controllers\Front\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'tags')->orderBy('id', 'DESC')->paginate(8);
        return view('Front.pages.posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $posts = Post::where('description', 'LIKE', '%' . $query . '%')->paginate(8)->withQueryString();
        return view('front.pages.Posts.search', compact('posts'));
    }
}
