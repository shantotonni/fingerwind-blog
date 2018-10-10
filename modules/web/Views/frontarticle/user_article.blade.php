
@extends('home_layouts.master')
@section('title')
    Fingerwind | My Article
@endsection
@section('content')

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="container wrap">
            <div class="col-md-12 content-left">
                <div class="articles">
                    <header>
                        <h3 class="title-head">My Article</h3>
                    </header>
                    @if(session()->has('msg'))
                        <div class="alert alert-success">
                            {{ session()->get('msg') }}
                        </div>
                    @endif
                    <br>
                    <a href="{{ route('user.create.article') }}" class="pull-right btn btn-primary">Create Article</a>
                    <div class="contact_grid">
                        <table class="table table-bordered">

                            <tbody>
                            <tr style="background-color: #3fa079">
                                <td>Title</td>
                                <td>Category</td>
                                <td>Sub Category</td>
                                <td>Article Create Date</td>
                                <td>Status</td>
                                <td>Action</td>

                            </tr>
                            @foreach($article as $value)
                            <tr>
                                <td><a href="{{ route('single.article',$value->id) }}">{{ $value->title }}</a></td>
                                <td>{{ isset($value->category->name)?$value->category->name:'' }}</td>
                                <td>{{ isset($value->subcategory->name)?$value->subcategory->name:'' }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    @if($value->status=='active')
                                        <span style="color: #3fa079">Published</span>
                                        @else
                                        <span style="color: red">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.article.edit',$value->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('user.article.delete',$value->id) }}" onclick="return confirm('Are you sure you want to delete this Article?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- content-section-ends-here -->
    @include('home_layouts.modal')


@endsection





