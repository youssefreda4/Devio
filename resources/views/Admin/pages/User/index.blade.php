@extends('Admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">All Users</h1>
                <a href="{{ route('users.create') }}" class="btn btn-primary my-3">Add New User</a>
            </div>
            <div class="col-12">
                <x-error></x-error>
                <x-success></x-success>
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Posts</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>

                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('users.posts', $user->id) }}" class="btn btn-primary">Show</a>
                                </td>
                                <td class="text-center">{!! $user->type() !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POSt">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" href="" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
