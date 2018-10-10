
@extends('home_layouts.master')
@section('title')
    FingerWind | Single Article
@endsection
@section('content')
    <br>
    <div class="main-body" id="pjax_options">
        <div class="container wrap">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Single Page</li>
            </ol>
            <div class="single-page">
                <div class="row">
                    <div class="col-md-9 col-lg-9 content-left single-post">
                        <div class="blog-posts">
                            <section class="author-box">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-xs-offset-3 col-sm-2 col-sm-offset-0">
                                                <img class="img-responsive img-circle center-block" src="{{ asset('images/'.$single_article->user->image) }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-8">
                                                <hr class="visible-xs-block">
                                                <div class="author-box-intro small text-muted" style="margin-bottom: 10px">About the Writer</div>
                                                <div class="author-inline-block" style="margin-bottom: 10px">
                                                    <h4 class="author-box-title">
                                                        <span class="author-name text-primary"><a href="{{ route('user_all_article',$single_article->post_by) }}">{{ isset($single_article->user)?$single_article->user->first_name:'' }}</a></span>
                                                    </h4>
                                                </div>
                                                <div class="author-box-content">Taylor K. Gordon is a freelance blogger and personal finance junkie who lives in the nation's capital. She documents her path to financial freedom and adventures in solopreneurship on her blog, Trendy Cheapo.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <form action="{{ route('article.view.count') }}" style="display: none" method="post" class="view_form">
                                {{ csrf_field() }}
                                <input type="hidden" name="view_count" value="{{ $single_article->id }}" id="view-count">
                            </form>

                            <hr>

                            <h3 class="post">{{ ucfirst($single_article->title) }}</h3>

                            <div class="user-show">
                                <ul>
                                    <li style="margin: 0;padding: 0;font-size: 12px">Publish: {{ $single_article->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                            <br>
                            <img class="img-full" src="{{ asset('article/'.$single_article->image) }}" style="width: 100%" alt="{{ asset('img/no.png') }}">
                            <div class="last-article" style="line-height: 200%">
                                <div class="description">{!! $single_article->description !!}</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>


                        <div class="subscribe-card --inside-article">
                            <h3 class="alert alert-success" style="display: none">Success</h3>
                            <h3 class="alert alert-danger" style="display: none">Error</h3>
                            <h4 class="subscribe-title text-center text-uppercase">Get FingerWind content delivered straight to your
                                inbox.</h4>

                            <form action="{{ route('user.subscribe') }}" method="post" id="subscribe" class="ng-pristine ng-invalid ng-touched">
                                <div class="row">
                                    <div class="col-md-8 col-lg-7 ml-auto mr-auto">
                                        <div class="row row-subscribe">
                                            <div class="col-sm-9">
                                                <input class="form-control mb-1 ng-pristine ng-invalid ng-touched" name="email" placeholder="Your Email Address" type="email">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="btn btn-second btn-block mb-1" type="submit" value="Subscribe">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="life-style">
                            <header>
                                <p class="title-head text-center" style="font-size: 25px;color: #35b578">SIMILAR READS</p>
                                <hr>
                            </header>
                            <div class="row related-posts" style="margin: 0">
                                @foreach($article_sismilar as $value)

                                    @if($value->id != $single_article->id)
                                        <div class="col-xs-6 col-md-4 related-grids">
                                            <a href="{{ route('single.article',$value->id) }}" class="thumbnail" style="margin: 0">
                                                <img style="width: 300px;height:168px " src="{{ asset('article/'. $value->image) }}" alt=""/>
                                            </a>
                                            <h5>
                                                <a href="{{ route('single.article',$value->id) }}" style="line-height: 25px">{{ ucfirst($value->title) }}</a>
                                            </h5>
                                        </div>
                                    @endif
                                @endforeach

                            </div>

                            <div class="response">
                                <h4 style="border-bottom: 1px solid #35b578;margin: 0;color: #35b578">Responses</h4>

                                @foreach($single_article->comment as $value )
                                    <div class="media response-info">
                                        <div class="media-left response-text-left">
                                            <a href="#">
                                                <img class="media-object" src="{{ asset('images/'.$value->user->image) }}" alt="No Image"/>
                                            </a>
                                            <h5><a href="#">{{ ucfirst(isset($value->user->first_name)?$value->user->first_name:'') }}</a></h5>
                                        </div>
                                        <div class="media-body response-text-right">
                                            <p>{{ $value->comment }}</p>
                                            <ul>
                                                <li>{{ $value->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                @endforeach

                            </div>
                            <br>
                            <div class="coment-form" style="margin: 0px">
                                <h4>Leave your comment</h4>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <form action="{{ route('user.comment',$single_article->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <textarea required="" name="comment" placeholder="Write Your Comment"></textarea>
                                        <input type="submit" value="Submit Your Comment">
                                    </form>
                                @else
                                    <h4>Please <a href="" data-toggle="modal" data-target="#login">Login</a></h4>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                       <div class="sidebar widget">
                            <h3 style="font-size: 20px">Recent Post</h3>
                            <ul>
                                @foreach($article as $value)
                                    @if($value->id != $single_article->id)
                                        <li>
                                            <div class="sidebar-thumb">
                                                <a href="{{ route('single.article',$value->id) }}">
                                                    <img class="animated rollIn" src="{{ asset('article/'. $value->image) }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="sidebar-content">
                                                <h5 class="animated bounceInRight"><a href="{{ route('single.article',$value->id) }}">{{ ucfirst($value->title) }}</a></h5>
                                            </div>
                                            <div class="sidebar-meta">
                                                <span class="time" ><i class="fa fa-clock-o"></i> Aug 27, 2015</span>
                                                <span class="comment"><i class="fa fa-comment"></i> 10 comments</span>
                                            </div>
                                        </li>

                                    @endif

                                @endforeach

                            </ul>
                       </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- content-section-ends-here -->

    @include('home_layouts.modal')

<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).delegate('#subscribe','submit',function (e) {
        e.preventDefault();

        var t=$(this).serialize();

        $.ajax({

            url: $(this).attr('action'),
            type: 'POST',
            data: t,
            success: function (data) {

                data = jQuery.parseJSON(data);
                if(data.result == 'success'){
                    console.log(data);
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }

            }

        });
        return false;
    });

    $(document).delegate('#voting','click',function (e) {
        e.preventDefault();

        var id= $('#article_id').val();

        $.ajax({

            url: '{{ route('user.voting') }}',
            type: 'POST',
            data: {id:id},
            success: function (data) {


               data = jQuery.parseJSON(data);
                if(data.result == 'success'){
                    toastr.success(data.message);
                    $.pjax.reload('#pjax_options');
                }else{
                    toastr.error(data.message);
                }

            }

        });
    });

    $(document).delegate('#bookmark','click',function (e) {
        e.preventDefault();
        var id= $('#articles_id').val();
        $.ajax({

            url: '{{ route('user.bookmark') }}',
            type: 'POST',
            data: {id:id},
            success: function (data) {

                data = jQuery.parseJSON(data);
                if(data.result == 'success'){
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }
        });
    });

    var id= $('#view-count').val();
    setTimeout(function () {

        $.ajax({

            url: '{{ route('article.view.count') }}',
            type: 'POST',
            data: {id:id},
            success: function (data) {

                console.log(data);

            }
        });

    },1000);

</script>

<style>

    .panel-default {
        border-color: #77eab4;
    }
    .panel {
        border-radius: 0px;
    }
        ul, li {
            list-style: none;
        }
        h5{
            margin: 0;

        }
        h3{
            color: #35b578;
            margin: 10px 0px 15px;
            padding-bottom:10px;
            padding-left: 10px;
            border-left: 5px solid #35b578;
        }
        .sidebar.widget {
            border: 1px solid #b6f7d0;
            padding: 10px 20px;
        }
        .sidebar.widget ul {
            margin: 0px;
            padding: 0;
            overflow: hidden;
        }
        .sidebar.widget ul li {
            overflow: hidden;
            font-size: 14px;
            margin-bottom: 20px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 20px
        }
        .sidebar-thumb{
            overflow: hidden;
        }
        .sidebar-thumb img{
            width: 100%;
            height: 130px;
        }
        .sidebar-content h5{
            font-size: 16px;
            cursor: pointer;
            line-height: 24px;
        }
        .sidebar-content h5 a:hover{
            color: #2996bd;
        }

        .sidebar-content h5 a{
            outline: 0 none;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }
        .sidebar-meta{
            margin-top: 10px;
        }
        .sidebar-meta span{
            color: #2e2e2e;
        }
        .sidebar-meta span.time{
            /*margin-right: 10px;*/
        }
        .sidebar-meta span i{
            color: #35b578
        }
    </style>

@endsection





