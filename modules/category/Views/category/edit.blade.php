@extends('layouts.master')

@section('title')
    Edit Category | Finger Wind
@endsection

@section('content')

<div class="padding-top">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{!! route('home') !!}">Dashboard</a></li>
                <li><a href="{!! route('category.index') !!}">Category</a></li>
                <li class="active">Edit</li>
            </ul>

            @if (count($errors))
                <ul>
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
                        Edit Category
                        <a href="{!! route('category.index') !!}" class="btn btn-success btn-xs pull-right">Back To Category</a>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($category,['files'=> true, 'route'=> ['category.update',$category->id], "novalidate"=>"novalidate" ]) !!}

                        @include('category::category._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>

@endsection
