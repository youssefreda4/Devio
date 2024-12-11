@extends('Admin.layouts.master')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">All Posts For {{ $user->name }}</h1>
        </div>
        @forelse ($user->post as $post)
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $post->user->name }}</h5>
                            <small class="text-muted">{{ $post->created_at->format('Y-m-d') }}</small>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ $post->title }}</h6>
                            <p class="card-text">{{ Str::limit($post->description, 50, '...') }}</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-primary">Show Post</a>
                        <form action="{{ route('post.delete', $post->id) }}" method="POST" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h3 class="mt-3 p-3 border text-center bg-info text-white rounded">No Result of search!</h3>
            </div>
        @endforelse
    </div>
</div>


@endsection
