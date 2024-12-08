<?php

namespace App\Http\Controllers\Front\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(12);
        return view('Front.pages.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Front.pages.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $userData = $request->validated();
        User::create($userData);
        return back()->with('success', 'User added successfully');
    }

    public function posts(User $user)
    {
        // $posts = Post::with('user')->where('user_id',$user->id)->get();
        // $user = User::findOrFail($user->id)->get();
        // dd($user->id);
        return view('Front.pages.User.posts', compact('user'));
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
        return view('Front.pages.User.edit', compact('user'));
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
            'type' => 'required|in:admin,writer'
        ]);

        $data['password'] = $request->has('password') ? bcrypt($request->password) : $user->password;

        $user->update($data);

        return redirect()->route('users.index', $user->id)->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
