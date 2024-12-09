@extends('Front.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">All Posts</h1>
                @can('create-post')
                    <a href="{{ route('post.create') }}" class="btn btn-primary my-3">Add New Post</a>
                @endcan
            </div>
            <div class="col-12">
                <x-error></x-error>
                <x-success></x-success>
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Desciption</th>
                        <th>Writer</th>
                        <th>Tags</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ Str::limit($post->description, 50, '.........') }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    @foreach ($post->tags as $tag)
                                        <span class="badge bg-warning my-1">{{ $tag->name }}</span>
                                        <br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <img src="{{ $post->image() }}" height="100" width="100" alt="">
                                </td>
                                {{-- @can('update-post', $post) --}}
                                    <td class="text-center">
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info">Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('post.delete', $post->id) }}" method="POSt">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" href="" value="Delete" class="btn btn-danger">
                                        </form>
                                    </td>
                                {{-- @endcan --}}
                            </tr>
                        @empty
                            <div class="col-12">
                                <h3 class="mt-3 p-3 border text-center bg-info text-white rounded">No Result of search !
                                </h3>
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
