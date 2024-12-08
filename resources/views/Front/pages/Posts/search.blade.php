@extends('Front.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">All Posts</h1>
            </div>
            @forelse ($posts as $post)
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $post->user->name }}</h4>
                            <span class="text-muted">{{ $post->created_at->format('Y-m-d') }}</span>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 50, '.........') }}</p>

                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Show Post</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h3 class="mt-3 p-3 border text-center bg-info text-white rounded">No Result of search !</h3>
                </div>
            @endforelse
        </div>
    </div>
@endsection
