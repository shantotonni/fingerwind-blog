
@extends('home_layouts.master')

@section('title')
    Fingerwind | User Create Article
    @endsection

@section('content')

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="container wrap">
            <div class="col-md-12 content-left">
                <div class="articles">
                    <header>
                        <h3 class="title-head">User Create Article</h3>
                    </header>
                    <br>
                    <a href="{{ route('user.article') }}" class="pull-right btn btn-primary">Back</a>
                    <div class="contact_grid">
                        <div class="col-md-12 contact-top">
                            <form action="{{ route('user.article.store') }}" method="post" class="contact_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="to">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="category_id" id="" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($category as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="to">
                                    <input type="text" style="width: 48.6%  " class="text" placeholder="Please Select Title" name="title">
                                </div>

                                <textarea name="description" placeholder="Please write Somethings" ></textarea>
                                <br>
                                <div class="to">
                                    <input type="file" class="text" placeholder="Please Select Image" name="image">
                                </div>
                                <br>
                                <div class="form-submit1">
                                    <input name="submit" type="submit" id="submit" value="Publish Your Article"><br>
                                </div>
                                <div class="clearfix"> </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- content-section-ends-here -->
    @include('home_layouts.modal')


    <script type="text/javascript">

//        $('.datepicker').datepicker({
//            autoclose: true,
//            format: "yyyy-mm-dd"
//        });
//
//        $('#timepicker').timepicker({
//            timeFormat: 'H:i:s',
//
//        });

        CKEDITOR.replace( 'description' );

    </script>

@endsection





