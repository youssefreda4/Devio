@extends('Front.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">Add Tag</h1>
            </div>
            <div class="col-12 mx-auto mt-3">
                <x-error></x-error>
                <x-success></x-success>
                <form action="{{ route('tags.store') }}" method="POST" class="form border rounded p-3">

                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name"
                            placeholder="Enter your name">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
