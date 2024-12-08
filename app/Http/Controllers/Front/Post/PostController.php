<?php

namespace App\Http\Controllers\Front\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Front\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(12);
        return view('front.pages.posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $posts = Post::where('description', 'LIKE', '%' . $query . '%')->get();;
        return view('Front.pages.Posts.search', compact('posts'));
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        return view('front.pages.Posts.create', compact('users', 'tags'));
    }

    public function show(Post $post)
    {
        return view('front.pages.posts.show', compact('post'));
    }


    public function store(PostRequest $request)
    {

        $image = $request->file('image')->store('/public');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'user_id' => $request->writer
        ]);
        $post->tags()->sync($request->tags);
        return redirect()->route('post.create')->with('success', 'Post added successfully');
    }

    public function edit(Post $post)
    {
        $users = User::select('id', 'name')->get();
        $tags = User::select('id', 'name')->get();
        return view('Front.pages.Posts.edit', compact('post', 'users', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|min:8',
            'description' => 'required|string|max:1500',
            'writer' => 'required|exists:users,id',
        ]);

        $old_image = $post->image;
        if ($request->hasFile('image')) {
            File::delete($old_image);
            $request->validate([
                'image' => 'image|mimes:png,jpg,jpeg,gif'
            ]);
            $image_name = $request->file('image')->store('/public');
        } else {
            $image_name = $old_image;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_name,
            'user_id' => $request->writer
        ]);
        $post->tags()->detach();
        $post->tags()->sync($request->tags);
        return redirect()->route('post.view')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $postImage = $post->image;
        File::delete($postImage);
        $post->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}
