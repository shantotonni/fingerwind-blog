@extends('layouts.master')

@section('content')
    <br>
    <br>
    <br>
    <!-- Start page -->
    <div class="page">

        <section class="panel panel-default">

            <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> {{ $pageTitle }} <span style="color: #A54A7B" data-toggle="tooltip" title="all user role define from this page, example : system-user or admin" > (?) </span></strong></div>

            <div class="panel-body">

                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <a href="{{ route('user.role') }}" class="btn btn-w-lg btn-info"><strong>Role</strong></a>
                        </div>

                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <a href="{{ route('user.index.permission') }}" class="btn btn-w-lg btn-primary "><strong>Permission</strong></a>
                        </div>

                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <a href="{{ route('user.index.role.user') }}" class="btn btn-w-lg btn-success "><strong>Role User</strong></a>
                        </div>

                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <a href="{{ route('user.index.role.permission') }}" class="btn btn-w-lg btn-warning "><strong>Role Permission</strong></a>
                        </div>

                    </div>
                </div>

            </div>

        </section>


    </div>
    <!-- End page-->






@stop

