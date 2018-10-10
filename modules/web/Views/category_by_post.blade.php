
@extends('home_layouts.master')
@section('title')
    FingerWind | Post By Category
@endsection
@section('content')
    <!-- content-section-starts-here -->
    <section class="iq-blog overview-block-ptb grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-title text-center">
                        @if(count($category_name)>0)
                          <h2 class="title">Category Of {{ $category_name->name }}</h2>
                         @endif
                        @if(count($title)>0)
                          <h2 class="title">Search By {{ $title }}</h2>
                        @endif
                    </div>
                </div>
            </div>

        @if(count($article))
            <div class="row">
                @foreach($article as $value)
                    <div class="col-lg-4 col-sm-12 iq-mtb-20">
                        <div class="iq-blog-entry white-bg">
                            <div class="iq-entry-image clearfix">
                                <a href="{{ route('single.article',$value->id) }}"><img class="img-fluid" src="{{ asset('article/'.$value->image) }}" alt="#"></a>
                                <span class="tag"><i class="ion-image"></i><a style="color: white;font-size: 16px" href="{{ route('category_by_post',isset($value->category->id)?$value->category->id:'') }}">{{ isset($value->category->name)?$value->category->name:'' }}</a></span>
                            </div>
                            <div class="iq-blog-detail">
                                <div class="iq-entry-title iq-mb-10">
                                    <a href="{{ route('single.article',$value->id) }}">
                                        <h5 class="iq-tw-6">{{ ucfirst($value->title ) }}</h5>
                                    </a>
                                </div>
                                <div class="iq-entry-content">
                                    <p>
                                        {!! str_limit($value->description,100) !!}
                                    </p>
                                </div>

                                <a href="{{ route('single.article',$value->id) }}" style="background-color: #03d871;color: white;padding: 5px 14px">Read More...</a>
                                <a href="{{ route('user_all_article',$value->post_by) }}" style="color: #4fbf89;font-size: 12px;" class="pull-right">Post By->{{ isset($value->user->first_name)?$value->user->first_name:'' }}</a>
                                <ul class="iq-entry-meta iq-mt-10">
                                    <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>{{ $value->view_count }} View</a></li>
                                    <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> {{ $value->vote->count() }} like</a></li>
                                    <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> {{ $value->comment->count() }} comments</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else

            <h3 style="text-align: center;padding: 50px">Article Not Available Right Now.See The Others Category Article</h3>


        @endif


        </div>
    </section>


    <!-- content-section-ends-here -->
    @include('home_layouts.modal')




    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).delegate('.register_form','submit',function (e) {
            e.preventDefault();

            var formData = new FormData($(this)[0]);
            var t=$(this).serialize();
            var form = $(this);

            $.ajax({

                url: $(this).attr('action'),
                type: 'POST',
                data: t,
                success: function (data) {

                    if(data.error){

                        $('.alert-danger').show('');
                    }

                    if(data.success){

                        $('.alert-success').show('');
                    }


                }

            });
            return false;
        });

    </script>




@endsection





