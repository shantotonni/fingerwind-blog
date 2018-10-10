@extends('layouts.master')

@section('title')
    Dashboard | FingerWind
@endsection

@section('content')

    <div class="content-width" id="pjax_options">
        <div class="row">
            <div class="col-md-12">
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

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">FingerWind | Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-male fa-5x" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                @if(isset($user))
                                                    {{ count($user) }}
                                                    @endif
                                            </div>
                                            <div>Total Articles</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('article.index') }}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <script src="{{ asset('js/main.js') }}"></script>
    </div>


@endsection

