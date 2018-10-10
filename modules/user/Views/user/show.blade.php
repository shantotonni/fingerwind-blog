@extends('layouts.master')

@section('title')
    View User | Finger Wind
@endsection

@section('content')

    <div class="padding-top">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="{!! route('home') !!}">Dashboard</a></li>
                    <li><a href="{!! route('user-list.index') !!}">Uer List</a></li>
                    <li class="active">Show</li>
                </ul>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px">
                            User Information
                            <a href="{!! route('user-list.index') !!}" class="btn btn-success btn-xs pull-right">Back To User List</a>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <div style="">
                                    <table id="" class="table table-bordered table-hover table-striped">
                                        <tr>
                                            <th class="col-lg-4">User First Name : </th>
                                            <td> {!! $user->first_name !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">User Last Name : </th>
                                            <td> {!! $user->last_name !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">User Email : </th>
                                            <td> {!! $user->email !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">User Phone : </th>
                                            <td> {!! $user->phone !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">User Address : </th>
                                            <td> {!! $user->address !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">User Type : </th>
                                            <td> {!! $user->type !!}</td>
                                        </tr>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
