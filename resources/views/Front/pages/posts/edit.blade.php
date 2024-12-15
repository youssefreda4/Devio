@extends('front.layouts.master')
@section('front.content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/post-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Edit Post</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto mt-3">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('front.posts.update', $post->id) }}" method="POST" class="form border rounded p-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 ">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control rounded " name="title" value="{{ $post->title }}"
                            placeholder="Enter post title">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Post Description</label>
                        <textarea class="form-control rounded" name="description" id="description" cols="30" rows="5"
                            placeholder="Enter post description">{{ $post->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="">Tags</label>
                        <select name="tags[]" class="form-control rounded" multiple>
                            @foreach ($tags as $tag)
                                <option @if ($post->tags->contains('id', $tag->id)) selected @endif value="{{ $tag->id }}">
                                    {{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image">Post Image</label>
                        <input type="file" class="form-control rounded" name="image">
                    </div>

                    @if($post->image != NULL)
                    <div class="mb-3">
                        <div>
                            <label for="image" class="">Post Photo</label>
                        </div>
                        <img src="{{ $post->image() }}" class="rounded" alt="" width="700px">
                    </div>
                    @endif


                    <div class="mb-3 mb-3">
                        <input type="submit" class="btn btn-primary rounded" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
