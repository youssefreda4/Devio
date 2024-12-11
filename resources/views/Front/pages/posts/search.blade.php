@extends('Front.layouts.master')
@section('front.content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/post-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>All Posts</h1>
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
                @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="post.html">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ Str::limit($post->description, 200, '.......') }}</h3>
                        </a>
                        <div class="mb3">
                            <img src="{{ $post->image() }}" alt="">
                        </div>

                        <p class="post-meta">
                            Posted by
                            <strong>{{ $post->user->name }}</strong>
                            on {{ $post->created_at->format('Y-m-d') }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4 ml-3" />
                @endforeach
                
                 <!-- Paginate-->
                 <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
