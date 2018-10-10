@extends('layouts.master')

@section('title')
    Article Mail | Finger Wind
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
     <div style="padding-top: 50px">
        <ul class="breadcrumb">
            <li><a href="{!! route('home') !!}">Dashboard</a></li>
            <li><a href="{!! route('article.index') !!}">Article</a></li>
            <li class="active">Mail</li>
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

         @if(session()->has('msg'))
             <div class="alert alert-success">
                 {{ session()->get('msg') }}
             </div>
         @endif

        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"  style="background-color: #bdf0fb;font-size: 18px">
                    Send Mail Article Writer
                    <a href="{!! route('article.index') !!}" class="btn btn-success btn-xs pull-right">Back To Article</a>
                </div>
                <div class="panel-body">

                    {!! Form::open(['files'=> true, 'route'=> ['article.mail.send',$article->id]]) !!}


                    <div id="ht-inquiry-contact-container">
                        <div class="form-horizontal" role="form">
                            <fieldset>
                                <div>
                                    <div class="row-fluid">

                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    {!! Form::label('subject', 'Subject ') !!}<span class="required"> * </span>
                                                    <input type="text" name="subject" class="form-control" placeholder="Enter Subject" required>

                                                </div>
                                                @if ($errors->has('subject'))
                                                    <div class="error" style="color: red">{{ $errors->first('subject') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row-fluid">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    {!! Form::label('email', 'Email ') !!}<span class="required"> * </span>
                                                    <input type="text" name="email" value="{{ isset($article->user->email)?$article->user->email:'' }}" class="form-control" placeholder="Enter Email" required>
                                                </div>
                                                @if ($errors->has('email'))
                                                    <div class="error" style="color: red">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                                        <input type="hidden" name="user_id" value="{{ $article->post_by }}">


                                        <div class="row-fluid">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        {!! Form::label('description', 'Description:') !!}<span class="required"> * </span>
                                                        <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Enter Description" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="pull-right">
                        <button type="submit" style="margin-left: 16px" class="btn btn-primary">Submit</button>
                        <a href="{!! route('article.index') !!}" style="margin-left: 16px" class="btn btn-danger">Cancel</a>
                    </div>

                    <br>
                    <br>


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
