
@extends('home_layouts.master')
@section('title')
    Fingerwind | My Bookmark Article
@endsection
@section('content')

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="container wrap">
            <div class="col-md-12 content-left">
                <div class="articles">
                    <header>
                        <h3 class="title-head">My Bookmark Article</h3>
                    </header>
                    <br>
                    <div class="contact_grid">
                        <table class="table table-bordered">

                            <tbody>
                            <tr style="background-color: #3fa079">
                                <td>Title</td>
                                <td>Image</td>
                                <td>Article Create Date</td>
                            </tr>
                            @foreach($bookmark as $value)
                            <tr>
                                <td><a href="{{ route('single.article',$value->article_id) }}">{{ isset($value->article->title)?$value->article->title:'' }}</a></td>
                                <td> <img src="{{ asset('article/'.$value->article->image) }}" width="60px" height="50px" alt="{{ asset('img/no.png') }}"></td>
                                <td>{{ $value->created_at }}</td>
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





