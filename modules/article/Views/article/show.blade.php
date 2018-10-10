@extends('layouts.master')

@section('title')
    View Article | Finger Wind
@endsection

@section('content')

    <div class="padding-top">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="{!! route('home') !!}">Dashboard</a></li>
                    <li><a href="{!! route('article.index') !!}">Article</a></li>
                    <li class="active">Show</li>
                </ul>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px">
                            Article Information
                            <a href="{!! route('article.index') !!}" class="btn btn-success btn-xs pull-right">Back To Article</a>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">
                                <div style="">
                                    <table id="" class="table table-bordered table-hover table-striped">
                                        <tr>
                                            <th class="col-lg-4">Article Title : </th>
                                            <td> {!! $article->title !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Category Name : </th>
                                            <td> {!! isset($article->category->name)?$article->category->name:'' !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Sub Category Name : </th>
                                            <td> {!! isset($article->subcategory->name)?$article->subcategory->name:'' !!}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Article Description : </th>
                                            <td> {!! $article->description !!}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-lg-4">Article Image : </th>
                                            <td> <img src="{{ asset('article/'.$article->image) }}" width="100px" height="100px" alt="{{ asset('img/no.png') }}"></td>
                                        </tr>

                                        <tr>
                                            <th class="col-lg-4">Article Status : </th>
                                            <td> {!! ucfirst($article->status) !!}</td>
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
