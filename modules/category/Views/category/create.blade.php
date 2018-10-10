@extends('layouts.master')

@section('title')
    Create Category | Finger Wind
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
     <div style="padding-top: 50px">
        <ul class="breadcrumb">
            <li><a href="{!! route('home') !!}">Dashboard</a></li>
            <li><a href="{!! route('category.index') !!}">Category</a></li>
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
                    Add Category
                    <a href="{!! route('category.index') !!}" class="btn btn-success btn-xs pull-right">Back To Category</a>
                </div>
                <div class="panel-body">

                    {!! Form::open(['route' => 'category.store', 'files'=> true, 'id' => 'category_form', "class"=>"form floating-label" ]) !!}

                    @include('category::category._form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
