<?php

namespace App\Http\Controllers\Front\Post;

use File;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PostRequest;
use App\Notifications\CommentNotification;
use App\Http\Requests\Front\CommentRequest;
use App\Notifications\LikeNotification;

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

    public function show(Post $post)
    {
        $comments = Comment::with('user')->where('post_id', $post->id)->get();
        return view('front.pages.Posts.show', compact('post', 'comments'));
    }

    public function postsTag(Tag $tag)
    {
        return view('front.pages.posts.tag', compact('tag'));
    }

    public function create()
    {
        // Gate::authorize('create-post');
        $users = User::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        return view('Front.pages.Posts.create', compact('users', 'tags'));
    }

    public function store(PostRequest $request)
    {
        // Gate::authorize('create-post');

        $image = $request->file('image')->store('/public');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'user_id' => auth()->user()->id
        ]);
        $post->tags()->sync($request->tags);
        return redirect()->route('front.posts')->with('success', 'Post added successfully');
    }

    public function likedStore(Post $post)
    {
        $user_id = auth()->user()->id;
        $findLike = Like::where('post_id', $post->id)
            ->where('user_id', $user_id)
            ->count();

        if ($findLike >= 1) {
            return back();
        }

        $like = Like::create([
            'post_id' => $post->id,
            'user_id' => $user_id
        ]);

        $user = $post->user;
        $user->notify(new LikeNotification($like));
        return back();
    }

    public function storeComment(CommentRequest $request, Post $post)
    {
        $data = Comment::create([
            'content' => $request->comment,
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]);

        $user = $post->user;
        // dd($user);
        $user->notify(new CommentNotification($data));

        return redirect()->route('front.posts.show', $post->id)->with('success', 'Comment added successfully');
    }

    public function markAsRead($notification)
    {
        $notification = auth()->user()->notifications->find($notification);
        if ($notification) {
            $notification->markAsRead();
        }
        return back();
    }

    public function edit(Post $post)
    {
        $tags = User::select('id', 'name')->get();
        return view('front.pages.Posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|min:8',
            'description' => 'required|string|max:1500',
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
        ]);
        $post->tags()->detach();
        $post->tags()->sync($request->tags);
        return redirect()->route('front.posts')->with('success', 'Post updated successfully');
    }


    public function commentDestroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully');
    }

    public function destroy(Post $post)
    {
        $postImage = $post->image;
        File::delete($postImage);
        $post->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}
