@extends('layouts.master')

@section('title')
    User List | Finger Wind
@endsection

@section('content')

<div id="pjax_options" class="padding-top">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{!! route('home') !!}">Dashboard
                <li><a href="{!! route('user-list.index') !!}">User-List</a></li>
            </ul>
            {{--<ul class="breadcrumb pull-right" style="padding-right: 0px">--}}
             {{--<li>--}}
                 {{--<a href="{!! route('article.create') !!}" class="btn btn-success btn-sm"><i class="fa fa-plus-square" aria-hidden="true">--}}
                     {{--</i>--}}
                     {{--<span style="margin-left: 10px">Add Article</span>--}}
                 {{--</a>--}}
             {{--</li>--}}
            {{--</ul>--}}


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
                        <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px;text-transform: uppercase">All User</div>
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
                                         First Name
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Last Name
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                       Email
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                         Image
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                         User Type
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                         Status
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

                                @if(count($all_user)>0)
                                    @foreach($all_user as $value)
                                        <tr id="srow_11303763">
                                            <td>{!! $i++ !!}</td>
                                            <td>{!! $value->first_name !!}</td>
                                            <td>{!! $value->last_name !!}</td>
                                            <td>{!! $value->email !!}</td>

                                            <td>
                                                <img src="{{ asset('images/'.$value->image) }}" width="80px" height="80px" alt="{{ asset('img/no.png') }}">
                                            </td>
                                            <td>{{ $value->type }}</td>
                                            <td>{{ $value->status }}</td>

                                            <td class="jq-dropdown-container">
                                                <a href="{{ route('edit.profile',$value->id) }}"  class="btn btn-success"> <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('user.profile.show',$value->id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
                                                <a href="{{ route('user.profile.delete',$value->id) }}" onclick="alert('Are You Sure?')" class="btn btn-primary"> <i class="fa fa-trash"></i></a>
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
