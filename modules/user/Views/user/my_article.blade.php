@extends('layouts.master')

@section('title')
   My article | Finger Wind
@endsection

@section('content')

<div id="pjax_options" class="padding-top">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{!! route('home') !!}">Dashboard
                <li><a href="">My Article</a></li>
            </ul>

            <br>
            <br>

            @if(session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif
            @if(session()->has('delete'))
                <div class="alert alert-danger">
                    {{ session()->get('delete') }}
                </div>
            @endif

             <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px;text-transform: uppercase">All My Article</div>
                        <div class="panel-body">
                            <table class="projects-table data_table">
                                <thead style="background-color: #064685;color: white">
                                <tr>
                                    <th class="table-project-cell">
                                      <span>
                                       Serial No
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Article Title
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Article Category
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Article Sub Category
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                       Article Status
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                         Action
                                      </span>
                                    </th>
                                </tr>
                                </thead>
                                <?php
                                $i=1;
                                ?>

                                <tbody class="customers">

                                @if(count($article)>0)
                                    @foreach($article as $value)
                                        <tr id="srow_11303763">
                                            <td>{!! $i++ !!}</td>
                                            <td>{!! $value->title !!}</td>
                                            <td>{!! isset($value->category->name)?$value->category->name:'' !!}</td>
                                            <td>{!! isset($value->subcategory->name)?$value->subcategory->name:'' !!}</td>

                                            <td>@if($value->status=='active')
                                                <span style="font-weight: bold;color: green">Published</span>
                                                    @else
                                                    <span style="font-weight: bold;color: red">Not Published</span>

                                                    @endif
                                            </td>

                                            <td class="jq-dropdown-container">
                                                {{--<a href="{{ route('article.edit',$value->id) }}"  class="btn btn-success"> <i class="fa fa-edit"></i></a>--}}
                                                <a href="{{ route('article.show',$value->id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
                                                {{--<a href="{{ route('article.delete',$value->id) }}" onclick="alert('Are You Sure?')" class="btn btn-primary"> <i class="fa fa-trash"></i></a>--}}
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
              </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</div>


@endsection
