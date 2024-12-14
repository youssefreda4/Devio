@extends('Admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">Edit Setting</h1>
            </div>
            <div class="col-12 mx-auto mt-3">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('settings.update',$setting->id) }}" method="POST" class="form border rounded p-3"
                    novalidate>
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $setting->site_name }}" name="site_name"
                             placeholder="Enter your site name">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="url" class="form-control" value="{{ $setting->facebook }}" name="facebook"
                                    placeholder="Enter your facebook link">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Youtube</label>
                                <input type="url" class="form-control" value="{{ $setting->youtube }}" name="youtube"
                                     placeholder="Enter your youtube link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Linkedin</label>
                                <input type="url" class="form-control" value="{{ $setting->linkedin }}" name="linkedin"
                                    id="linkedin" placeholder="Enter your linkedin link">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Twitter</label>
                                <input type="url" class="form-control" value="{{ $setting->twitter }}" name="twitter"
                                     placeholder="Enter your twitter link">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">About Us</label>
                        <textarea name="about_us_content" class="form-control" cols="30" rows="8">{{ strip_tags($setting->about_us_content) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
