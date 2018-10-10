
@extends('home_layouts.master')
@section('title')
    FingerWind | User Profile
    @endsection
@section('content')

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="container wrap">
            <div class="col-md-12 content-left">
                <div class="articles">
                    <header>
                        <h3 class="title-head">User Profile</h3>
                    </header>
                    @if(session()->has('msg'))
                        <div class="alert alert-success">
                            {{ session()->get('msg') }}
                        </div>
                    @endif
                    <br>
                    <a href="{{ route('front.user.profile.edit',$profile->id) }}" class="pull-right btn btn-primary">Edit Profile</a>
                    <div class="contact_grid">

                    <table class="table table-bordered">

                        <tbody>
                        <tr>
                            <td>Image</td>
                            <td>  <img src="{{ asset('images/'.$profile->image) }}" width="80px" height="80px" alt="{{ asset('img/no.png') }}"></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td>{{ $profile->first_name }}</td>

                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>{{ $profile->last_name }}</td>

                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $profile->email }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ ucfirst($profile->gender) }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $profile->phone }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $profile->address }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ ucfirst($profile->city) }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ ucfirst($profile->country) }}</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>{{ ucfirst($profile->state) }}</td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td>{{ $profile->zip_code }}</td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td>{{ $profile->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>{{ ucfirst($profile->type) }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ ucfirst($profile->status) }}</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- content-section-ends-here -->
    @include('home_layouts.modal')


@endsection





