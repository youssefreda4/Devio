@extends('Admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">All Posts</h1>
        </div>
        @forelse ($posts as $post)
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card h-100 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $post->user->name }}</h5>
                        <small class="text-muted">{{ $post->created_at->format('Y-m-d') }}</small>
                    </div>
                    <div class="m-2 text-center">
                        <img src="{{ $post->image() }}" class="img-fluid" style="max-height: 200px;" alt="">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ $post->title }}</h6>
                        <p class="card-text">{{ Str::limit($post->description, 100, '...') }}</p>
                    </div>
                    <div class="card-footer mt-auto text-center">
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-primary">Show Post</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h3 class="mt-3 p-3 border text-center bg-info text-white rounded">No Result of search!</h3>
            </div>
        @endforelse
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>


@endsection
