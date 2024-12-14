@extends('Admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 p-3 border text-center bg-dark text-white rounded">Settings</h1>
                <a href="{{ route('settings.edit',$setting->id) }}" class="btn btn-primary my-3">Edit</a>
            </div>
            <div class="col-12">
                <x-error></x-error>
                <x-success></x-success>
                <table class="table table-bordered">
                    <thead>
                        <th>Site Name</th>
                        <th>About Us</th>
                        <th>Facebook</th>
                        <th>Youtube</th>
                        <th>Linhedin</th>
                        <th>Twitter</th>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $setting->site_name }}</td>
                                <td>{{ $setting->about_us_content }}</td>
                                <td>{{ $setting->facebook }}</td>
                                <td>{{ $setting->youtube }}</td>
                                <td>{{ $setting->linkedin }}</td>
                                <td>{{ $setting->twitter }}</td>
                               
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
