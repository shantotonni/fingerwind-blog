@extends('layouts.master')

@section('title')
    Article | Finger Wind
@endsection

@section('content')

<div id="pjax_options" class="padding-top">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{!! route('home') !!}">Dashboard
                <li><a href="{!! route('article.index') !!}">Article</a></li>
            </ul>
            <ul class="breadcrumb pull-right" style="padding-right: 0px">
             <li>
                 <a href="{!! route('article.create') !!}" class="btn btn-success btn-sm"><i class="fa fa-plus-square" aria-hidden="true">
                     </i>
                     <span style="margin-left: 10px">Add Article</span>
                 </a>
             </li>
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
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px;text-transform: uppercase">All Article</div>
                        <div class="panel-body">
                            <table class="projects-table data_table">
                                <thead style="background-color: #064685;color: white">
                                <tr>
                                    <th class="table-project-cell" width="10%">
                                      <span>
                                        Serial No
                                      </span>
                                    </th>
                                    <th class="table-project-cell" width="20%">
                                      <span>
                                          Article Title
                                      </span>
                                    </th>
                                    <th class="table-project-cell" width="10">
                                      <span>
                                        Category
                                      </span>
                                    </th>

                                    <th class="table-project-cell" width="15%">
                                      <span>
                                         Description
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                         Image
                                      </span>
                                    </th>
                                    <th class="table-project-cell" width="5%">
                                      <span>
                                         Word
                                      </span>
                                    </th>
                                    <th class="table-project-cell" width="5%">
                                      <span>
                                         Status
                                      </span>
                                    </th>
                                    <th class="table-project-cell" width="5%">
                                      <span>
                                         Mail
                                      </span>
                                    </th>

                                    <th class="table-project-cell" width="15%">
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
                                            <td>{!! strip_tags($value->title) !!}</td>
                                            <td>{!! isset($value->category->name)?$value->category->name:'' !!}</td>
                                            <td>{!! strip_tags(substr($value->description,0,50)) !!}</td>
                                            <td>
                                                <img src="{{ asset('article/'.$value->image) }}" width="80px" height="60px" alt="{{ asset('img/no.png') }}">
                                            </td>
                                            <td>{{ $value->word_count }}</td>
                                            <td>
                                               @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')
                                                    @if($value->status=='inactive')
                                                        <a href="{!! route('article.active',['id' => $value->id,'active' => 'active']) !!}" class="btn btn-danger btn-xs">Inactive</a>
                                                    @else
                                                        <a href="{!! route('article.inactive',['id' => $value->id,'inactive' => 'inactive']) !!}" class="btn btn-primary btn-xs">Active</a>
                                                    @endif
                                                   @else
                                                Inactive
                                                @endif

                                            </td>
                                            <td>

                                                @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')

                                                    <a href="{{ route('article.mail',$value->id) }}" class="btn btn-info btn-xs">Send Mail</a>
                                                    <br>
                                                    <a href="{{ route('user.send.mail.list',$value->id) }}" class="btn btn-success btn-xs">Mail List</a>
                                                @endif
                                            </td>

                                            <td class="jq-dropdown-container">
                                                <a href="{{ route('article.edit',$value->id) }}"  class="btn btn-success"> <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('article.show',$value->id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
                                                <a href="{{ route('article.delete',$value->id) }}" onclick="return confirm('Are you sure you want to delete this Article?');" class="btn btn-danger"> <i class="fa fa-trash"></i></a>
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
