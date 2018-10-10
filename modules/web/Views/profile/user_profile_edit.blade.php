
@extends('home_layouts.master')
@section('title')
    FingerWind | User Profile Edit
@endsection
@section('content')

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="container wrap">
            <div class="col-md-12 content-left">
                <div class="articles">
                    <header>
                        <h3 class="title-head">User Profile Edit</h3>
                    </header>
                    <br>
                    <a href="{{ route('front.user.profile') }}" class="pull-right btn btn-primary">Back</a>
                    <div class="contact_grid">
                        <div class="col-md-12 contact-top">
                            <form action="{{ route('front.user.profile.update',$profile->id) }}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <div class="to">
                                    <img src="{{ asset('images/'.$profile->image) }}" width="120px" height="120px" alt="NO Image">
                                    <br>
                                    <br>
                                    <input type="file" class="text"  name="image" placeholder="Enter Your First Name">
                                </div>
                                <br>
                                <div class="to">
                                    <input type="text" class="text" value="{{ $profile->first_name }}" name="first_name" placeholder="Enter Your First Name">
                                    <input type="text" class="text" name="last_name" value="{{ $profile->last_name }}" placeholder="Enter Your Last Name" style="margin-left:30px">
                                </div>

                                <div class="to">
                                    <input type="text" class="text" name="email" value="{{ $profile->email }}" placeholder="Enter Your Email">
                                    <input type="text" class="text" name="phone"  value="{{ $profile->phone }}" placeholder="Enter Your Phone" style="margin-left:30px">
                                </div>
                                <div class="to">
                                    <select name="gender" id="" style="width: 47%"  class="form-control">
                                        <option value="">Select Gender</option>
                                        @if($profile->gender=='male')
                                        <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                            @elseif($profile->gender=='female')
                                            <option value="female" selected>Female</option>
                                            <option value="male">Male</option>
                                            @endif
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="to">
                                    <input type="text" class="text" style="width: 97%" name="address" value="{{ $profile->address }}" placeholder="Enter Your Address">
                                </div>

                                <div class="to">
                                    <input type="text" class="text" name="city" value="{{ $profile->city }}" placeholder="Enter Your City">
                                    <input type="text" class="text" name="state" value="{{ $profile->state }}" placeholder="Enter Your State" style="margin-left:30px">

                                </div>

                                <div class="to">
                                    <input type="text" class="text" name="country" value="{{ $profile->country }}" placeholder="Enter Your Country">
                                    <input type="text" class="text" name="zip_code" value="{{ $profile->zip_code }}" placeholder="Enter Your Zip Code" style="margin-left:30px">

                                </div>
                                <div class="to">
                                    <input type="text" class="text" data-provide="datepicker" name="date_of_birth" value="{{ $profile->date_of_birth }}" placeholder="Enter Your Birth Date">

                                </div>


                                <div class="form-submit1">
                                    <input name="submit" type="submit" id="submit" value="Update Profile"><br>
                                </div>
                                <div class="clearfix"> </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- content-section-ends-here -->
    @include('home_layouts.modal')


    <script>
        $('.datepicker').datepicker();
    </script>

@endsection





