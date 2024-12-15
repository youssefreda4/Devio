@extends('Front.layouts.master')
@section('front.content')
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
                        <div>
                            <h2 class="profile-name mb-1">{{ $user->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto mt-3 mb-5">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('front.profile.update', $user->id) }}" method="POST" class="form border rounded p-3"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name"
                            placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email"
                            placeholder="Enter your email">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3 ">
                        <input type="submit" class="btn btn-primary rounded" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
