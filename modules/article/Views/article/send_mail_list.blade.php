@extends('layouts.master')

@section('title')
    Article Send Mail List | Finger Wind
@endsection

@section('content')

<div id="pjax_options" class="padding-top">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{!! route('home') !!}">Dashboard
                <li><a href="{!! route('article.index') !!}">Article</a></li>
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
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px;text-transform: uppercase">All Article Send Mail List</div>
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
                                         Mail Subject
                                      </span>
                                    </th>
                                    <th class="table-project-cell" width="30%">
                                      <span>
                                       Mail Description
                                      </span>
                                    </th>

                                    <th class="table-project-cell" width="15%">
                                      <span>
                                       Article Title
                                      </span>
                                    </th>

                                    <th class="table-project-cell" width="10%">
                                      <span>
                                         Article User
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
                            @if(isset($send_mail_list))
                                @if(count($send_mail_list)>0)
                                    @foreach($send_mail_list as $value)
                                        <tr id="srow_11303763">
                                            <td>{!! $i++ !!}</td>
                                            <td>{!! $value->subject !!}</td>
                                            <td>{!! substr($value->description,0,30) !!}</td>
                                            <td>{!! isset($value->article->title)?$value->article->title:'' !!}</td>
                                            <td>{!! isset($value->user->first_name)?$value->user->first_name:'' !!}</td>


                                            <td class="jq-dropdown-container">

                                                {{--<a href="{{ route('article.edit',$value->id) }}"  class="btn btn-success"> <i class="fa fa-edit"></i></a>--}}
                                                {{--<a href="{{ route('article.show',$value->id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i></a>--}}
                                                <a href="{{ route('mail.delete',$value->id) }}" onclick="return confirm('Are you sure you want to delete this Email?');" class="btn btn-danger"> <i class="fa fa-trash"></i></a>

                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                                @else

                                        No Send Mail List

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
