@extends('Front.layouts.master')
@section('front.content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>{{ config('app.name') }}</h1>
                        <div class="mt-3">
                            <form action="{{ route('front.posts.search') }}" method="get" class="d-flex" role="search">
                                <input class="form-control me-2" type="search" name="q" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </form>
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
                    <hr class="my-4" />
                @endforeach

                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase"
                        href="{{ route('front.posts') }}">Older
                        Posts →</a></div>
            </div>
        </div>
    </div>
@endsection
