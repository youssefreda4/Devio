<?php

namespace App\Http\Controllers\Admin\User;

use File;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     Gate::authorize('admin-control');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(12);
        return view('Admin.pages.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $image = $request->file('image')->store('/public/users');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => $request->type,
            'image' => $image
        ]);
        return back()->with('success', 'User added successfully');
    }

    public function posts(User $user)
    {
        // $posts = Post::with('user')->where('user_id',$user->id)->get();
        // $user = User::findOrFail($user->id)->get();
        // dd($user->id);
        return view('Admin.pages.User.posts', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('Admin.pages.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {


        
        $data = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            Rule::unique('users')->ignore($user->id),
            'password' => 'nullable|string|confirmed',
            'type' => 'required|in:admin,writer',
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

        $data['password'] = $request->has('password') ? bcrypt($request->password) : $user->password;
        $data['image'] = $image_name;
        $user->update($data);

        return redirect()->route('users.index', $user->id)->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $userImage = $user->image;
        File::delete($userImage);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
