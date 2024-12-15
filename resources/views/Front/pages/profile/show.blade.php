@extends('Front.layouts.master')
@section('front.content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/profile.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading d-flex align-items-center justify-content-center text-center">
                        <!-- Profile Image -->
                        <div class="profile-image-wrapper me-3">
                            <img src="{{ $user->image() }}" alt="Profile Image" class="profile-image rounded-circle"
                                width="300px" height="250px">
                        </div>
                        <!-- Profile Name and Edit Button -->
                        <div>
                            <h2 class="profile-name mb-1">{{ $user->name }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                <!-- Post preview-->
                @forelse ($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('front.posts.show', $post->id) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ Str::limit($post->description, 200, '.......') }}</h3>
                        </a>
                        @if ($post->image != null)
                            <div class="mb-3">
                                <img src="{{ $post->image() }}" class="rounded" alt="" width="700px">
                            </div>
                        @endif

                        @forelse ($post->tags as $tag)
                            <a href="{{ route('front.posts.showPostsTag', $tag->id) }}">

                                <span class="badge bg-warning rounded my-1">{{ $tag->name }}</span>
                            </a>
                            <br>
                        @empty
                            <span class="badge bg-danger rounded my-1">
                                No Tags!
                            </span>
                        @endforelse

                        <p class="post-meta">
                            Posted by
                            <strong>{{ $post->user->name }}</strong>
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
                        </div>
                    </div>
                @empty
                    <div class="col-12 mb-5">
                        <h3 class="mt-3 p-3 border text-center bg-primary text-white rounded">No posts yet !
                        </h3>
                    </div>

                    <!-- Divider-->
                    <hr class="my-4" />
                @endforelse

                <!-- Paginate-->
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
