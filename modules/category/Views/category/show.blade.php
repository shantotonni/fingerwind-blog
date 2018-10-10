@extends('layouts.master')

@section('title')
    View Category | Finger Wind
@endsection

@section('content')

    <div class="padding-top">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="{!! route('home') !!}">Dashboard</a></li>
                    <li><a href="{!! route('category.index') !!}">Article</a></li>
                    <li class="active">Show</li>
                </ul>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px">
                            Category Information
                            <a href="{!! route('category.index') !!}" class="btn btn-success btn-xs pull-right">Back To Category</a>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <div style="">
                                    <table id="" class="table table-bordered table-hover table-striped">
                                        <tr>
                                            <th class="col-lg-4">Category Title : </th>
                                            <td> {!! $category->title !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Category Name : </th>
                                            <td> {!! $category->name !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Category Image : </th>
                                            <td> <img src="{{ asset('img/'.$category->image) }}" width="100px" height="100px" alt="{{ asset('img/no.png') }}"></td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Created At : </th>
                                            <td> {!! $category->created_at !!}</td>
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
