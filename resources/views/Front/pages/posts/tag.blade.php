@extends('Front.layouts.master')
@section('front.content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/post-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <p>All Posts For This Tag :
                        <h3>{{ $tag->name }}</h3>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="col-12">
                    <a href="{{ route('front.posts.create') }}" class="btn btn-primary rounded my-3">Add New Post</a>
                </div>
                <x-error></x-error>
                <x-success></x-success>
                <!-- Post preview-->
                @foreach ($tag->posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('front.posts.show', $post->id) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ Str::limit($post->description, 200, '.......') }}</h3>
                        </a>
                        @if($post->image != NULL)
                        <div class="mb-3">
                            <img src="{{ $post->image() }}" class="rounded" alt="" width="700px">
                        </div>
                        @endif

                        <div class="mb-3">
                            <span class="badge bg-warning rounded my-1">{{ $tag->name }}</span>
                        </div>

                        <p class="post-meta">
                            Posted by
                            <a href="{{ route('front.profile.show', $post->user->id) }}">
                                <strong>{{ $post->user->name }}</strong>
                            </a>
                            on {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-start gap-2">
                            <!-- Like Button -->
                            <form action="{{ route('front.posts.likedstore', $post->id) }}" method="POST">
                                @csrf
                                <input type="submit" value="Like ({{ count($post->usersLiked) }})"
                                    class="btn btn-info rounded">
                            </form>

                            @auth
                                <!-- Edit and Delete Buttons -->
                                @if ($post->user_id == auth()->user()->id)
                                    <a href="{{ route('front.posts.edit', $post->id) }}"
                                        class="btn btn-primary rounded">Edit</a>

                                    <form action="{{ route('front.posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger rounded">
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4 ml-3" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
