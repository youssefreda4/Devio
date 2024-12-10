@extends('Admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">{{ $post->title }}</h1>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $post->user->name }}</h4>
                        <span class="text-muted">{{ $post->created_at->format('Y-m-d') }}</span>
                    </div>

                    <div class="m-3 text-center">
                        <img src="{{ $post->image() }}" height="400" width="50%" alt="">
                    </div>  

                    <div class="card-body">
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
