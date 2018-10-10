@extends('layouts.master')

@section('title')
    Profile Edit | Finger Wind
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
     <div style="padding-top: 50px">
        <ul class="breadcrumb">
            <li><a href="{!! route('home') !!}">Dashboard</a></li>
            <li>
                @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')
                   <a href="{!! route('user-list.index') !!}">User List</a>
                    @else
                    <a href="{!! route('user.profile') !!}">Profile</a>
                @endif

            </li>
            <li class="active">Edit</li>
        </ul>

         @if (count($errors))
             <ul style="margin: 0;padding: 0">
                 <div class="alert alert-success">
                 @foreach($errors->all() as $error)

                     <li>{!! $error !!}</li>

                 @endforeach
                 </div>
             </ul>
         @endif

        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px">
                    Edit Profile
                    @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')
                        <a href="{!! route('user-list.index') !!}" class="btn btn-success btn-xs pull-right">Back To Profile</a>

                        @else
                        <a href="{!! route('user-list.index') !!}" class="btn btn-success btn-xs pull-right">Back To User List</a>
                    @endif
                </div>
                <div class="panel-body">

                    {!! Form::model($user,['files'=> true, 'route'=> ['update.profile',$user->id ]]) !!}

                    @include('user::user._form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
