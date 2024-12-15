<?php

namespace App\Http\Controllers\Front\Profile;

use File;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(8);
        $user = User::find(auth()->user()->id);
        return view('Front.pages.profile.index', compact('posts', 'user'));
    }

    public function edit(User $user)
    {
        return view('Front.pages.profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            Rule::unique('users')->ignore($user->id),
            'image' => 'image'
        ]);

        $old_image = $user->image;
        if ($request->hasFile('image')) {
            File::delete($old_image);
            $request->validate([
                'image' => 'image|mimes:png,jpg,jpeg,gif'
            ]);
            $image_name = $request->file('image')->store('/public/users');
        } else {
            $image_name = $old_image;
        }

        $data['image'] = $image_name;
        $user->update($data);

        return redirect()->route('front.profile', $user->id)->with('success', 'User updated successfully');
    }

    public function show(User $user)
    {
        $posts = Post::with('user')
            ->where('user_id', $user->id)
            ->orderBy('id', 'DESC')
            ->paginate(8);
        return view('Front.pages.profile.show', compact('user', 'posts'));
    }
}
