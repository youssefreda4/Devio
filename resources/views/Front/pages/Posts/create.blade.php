@extends('Front.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">Add Posts</h1>
            </div>
            <div class="col-12 mx-auto mt-3">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('post.store') }}" method="POST" class="form border rounded p-3"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control" value="{{ old('title') }}" name="title" id="title"
                            placeholder="Enter post title">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Post Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                            placeholder="Enter post description">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="">Tags</label>
                        <select name="tags[]" class="form-control" multiple >
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Post Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Writer</label>
                        <select class="form-control" name="writer" id="writer">
                            <option value="" selected>Select Writer</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 ">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
