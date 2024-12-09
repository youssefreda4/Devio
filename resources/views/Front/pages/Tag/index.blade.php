@extends('Front.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">All Tags</h1>
                @can('create', Tag::class)
                    <a href="{{ route('tags.create') }}" class="btn btn-primary my-3">Add New Tag</a>
                @endcan
            </div>
            <div class="col-12">
                <x-error></x-error>
                <x-success></x-success>
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-center">Posts</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>

                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tags.posts', $tag->id) }}" class="btn btn-primary">Show</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info">Edit</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POSt">
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
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
