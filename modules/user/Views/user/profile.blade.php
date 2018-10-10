@extends('layouts.master')

@section('title')
    User List | Finger Wind
@endsection

@section('content')

<div id="pjax_options" class="padding-top">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{!! route('home') !!}">Dashboard</a></li>
            </ul>
            <br>
            <br>
            @if(session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #bdf0fb">
                       User Profile
                        <a href="{!! route('home') !!}" class="btn btn-success btn-xs pull-right">Back To Dashboard</a>
                        <a href="{!! route('edit.profile',$profile->id) !!}" style="margin-right: 20px" class="btn btn-success btn-xs pull-right">Edit Profile</a>
                    </div>
                    <h3 class="text-center" style="color: green;text-decoration: underline">Information</h3>
                    <div class="modal-body">
                        <div style="">
                            <table id="" class="table table-bordered table-hover table-striped">


                                <tr>
                                    <th class="col-lg-4">Image : </th>
                                    <td>

                                        {{--@if($employee->image==null)--}}

                                        <span style="margin-left: 100px;float: right;margin-top: 40px;margin-right: 400px">
                                                        <form action="{{ route('update.image',$profile->id) }}" method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="file" name="image">
                                                         <button type="submit" class="btn btn-success btn-xs" value="submit">Update</button>
                                                        </form>
                                                    </span>

                                        {{--@else--}}

                                        <img src="{{ asset('images/'.$profile->image) }}" width="100px" height="100px" alt="{{ asset('img/no.png') }}">


                                        {{--@endif--}}

                                    </td>
                                </tr>


                                <tr>
                                    <th class="col-lg-4">First Name : </th>
                                    <td>{!! $profile->first_name !!}</td>
                                </tr>
                                <tr>
                                    <th class="col-lg-4">Last Name : </th>
                                    <td>{!! $profile->last_name !!}</td>
                                </tr>
                                <tr>
                                    <th class="col-lg-4">Email : </th>
                                    <td>{!! $profile->email !!}</td>
                                </tr>

                                <tr>
                                    <th class="col-lg-4">Phone : </th>
                                    <td>{!! $profile->phone !!}</td>
                                </tr>

                                <tr>
                                    <th class="col-lg-4">Address : </th>
                                    <td>{!! $profile->address !!}</td>
                                </tr>
                                <tr>
                                    <th class="col-lg-4">Status : </th>
                                    <td>{!! ucfirst($profile->status) !!}</td>
                                </tr>

                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</div>


@endsection
