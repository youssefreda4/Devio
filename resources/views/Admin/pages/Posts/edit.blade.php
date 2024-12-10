@extends('Admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">Edit Posts</h1>
            </div>
            <div class="col-12 mx-auto mt-3">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('post.update', $post->id) }}" method="POST" class="form border p-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}"
                            placeholder="Enter post title">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Post Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                            placeholder="Enter post description">{{ $post->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="">Tags</label>
                        <select name="tags[]" class="form-control" multiple>
                            @foreach ($tags as $tag)
                                <option @if($post->tags->contains('id', $tag->id)) selected @endif value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Post Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Post Photo</label>
                        <img src="{{ $post->image() }}" height="350" width="100%" alt="">
                    </div>

                    <div class="mb-3">
                        <label for="writer" class="form-label">Writer</label>
                        <select class="form-control" name="writer" id="writer">
                            <option value="" selected>Select Writer</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected($post->user_id == $user->id)>
                                    {{ $user->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3 ">
                        <input type="submit" class="btn btn-primary" value="update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
