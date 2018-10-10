@extends('layouts.master')

@section('title')
    Create Article | Finger Wind
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
     <div style="padding-top: 50px">
        <ul class="breadcrumb">
            <li><a href="{!! route('home') !!}">Dashboard</a></li>
            <li><a href="{!! route('article.index') !!}">Article</a></li>
            <li class="active">Add</li>
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
                    Add Article
                    <a href="{!! route('article.index') !!}" class="btn btn-success btn-xs pull-right">Back To Article</a>
                </div>
                <div class="panel-body">

                    {!! Form::model($article,['files'=> true, 'route'=> ['article.store']]) !!}

                    @include('article::article._form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
