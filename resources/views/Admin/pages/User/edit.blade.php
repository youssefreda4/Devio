@extends('Admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">Edit User</h1>
            </div>
            <div class="col-12 mx-auto mt-3">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="form border rounded p-3">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name"
                            placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email"
                            placeholder="Enter your email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm your password">
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="" selected>Select Type</option>
                            <option value="admin" @selected($user->type == 'admin')>Admin</option>
                            <option value="writer" @selected($user->type == 'writer')>Writer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
