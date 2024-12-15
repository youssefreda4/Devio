@extends('Front.layouts.master')
@section('front.content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/post-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Post</h1>
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
                <div class="post-preview">
                    <a href="#">
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

                    <p class="mb-3">
                        Posted by
                        <a href="{{ route('front.profile.show', $post->user->id) }}">
                            <strong>{{ $post->user->name }}</strong>
                        </a>
                        on {{ $post->created_at->format('Y-m-d') }}
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
                                <a href="{{ route('front.posts.edit', $post->id) }}" class="btn btn-primary rounded">Edit</a>

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

                <!-- Comment Form -->
                <h3 class="mb-4">Total Comment ({{ count($post->comments) }})</h3>
                <x-error></x-error>
                <x-success></x-success>
                @auth
                    <form action="{{ route('front.posts.storecomment', $post->id) }}" method="POST" novalidate>
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control rounded" name="comment" rows="4" placeholder="Your comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary rounded mt-2">Add Comment</button>
                    </form>
                @else
                    <div class="col-12 mb-3">
                        <a href="{{ route('login') }}">
                            <h5 class="mt-3 p-3 border text-center bg-primary text-white rounded">For add comment must be login
                            </h5>
                        </a>
                    </div>
                @endauth
                <!-- Comments Section -->

                <div class="mt-4">
                    <div class="mb-3">
                        <h4>Comments: </h4>
                    </div>

                    @forelse ($comments as $comment)
                        <!-- Example Comment 1 -->
                        <div class="row mb-3 border rounded p-3">
                            <div class="col-9">
                                <a href="{{ route('front.profile.show', $post->user->id) }}">
                                    <h5 class="">{{ $comment->user->name }}</h5>
                                </a>
                                <p>{{ $comment->content }}</p>
                                <small class="text-muted"> {{ $comment->created_at->diffForHumans() }}</small>

                            </div>
                            @auth
                                @if ($comment->user_id == auth()->user()->id || $post->user_id == auth()->user()->id)
                                    <div class="col-3 mt-5">
                                        <form action="{{ route('front.posts.commentDestroy', $comment->id) }}" method="POSt">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" href="" value="Delete" class="btn btn-danger rounded">
                                        </form>
                                        {{-- <a href="" class="btn btn-danger my-3">Delete</a> --}}
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <div class="col-12 mb-5">
                            <h3 class="mt-3 p-3 border text-center bg-primary text-white rounded">No Comments yet !
                            </h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
