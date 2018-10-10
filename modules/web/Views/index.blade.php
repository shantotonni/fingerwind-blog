@extends('home_layouts.master')

@section('title')
    Home Page | FingerWind
@endsection

@section('content')

    @include('home_layouts.header_top_post')

    <!-- content-section-starts-here -->
    <section class="iq-blog overview-block-ptb grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-title text-center">
                        <h2 class="title iq-tw-6">Our Recent Post</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($article as $value)
                <div class="col-lg-4 col-sm-12 iq-mtb-20">
                    <div class="iq-blog-entry white-bg">
                        <div class="iq-entry-image clearfix">
                            <a href="{{ route('single.article',$value->id) }}"><img class="img-fluid" src="{{ asset('article/'.$value->image) }}" alt="#"></a>
                            <span class="tag">
                                <a style="color: white;font-size: 16px" href="{{ route('category_by_post',isset($value->category->id)?$value->category->id:'') }}">{{ isset($value->category->name)?$value->category->name:'' }}</a>
                            </span>
                        </div>
                        <div class="iq-blog-detail">
                            <div class="iq-entry-title iq-mb-10">
                                <a href="{{ route('single.article',$value->id) }}">
                                    <h5 class="iq-tw-6">{{ ucfirst($value->title ) }}</h5>
                                </a>
                            </div>
                            <div class="iq-entry-content">
                                <p>
                                    {!! str_limit($value->description,90) !!}
                                </p>
                            </div>

                            <a href="{{ route('single.article',$value->id) }}" style="background-color: #03d871;color: white;padding: 5px 14px">Read More...</a>
                            <a href="{{ route('user_all_article',$value->post_by) }}" style="color: #4fbf89;font-size: 12px;" class="pull-right">Post By {{ isset($value->user->first_name)?$value->user->first_name:'' }}</a>
                            <ul class="iq-entry-meta iq-mt-10">
                                <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> {{ $value->view_count }}</a></li>
                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{ $value->vote->count() }} </a></li>
                                <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> {{ $value->comment->count() }} </a></li>
                                <li>
                                    <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <?php
                                        $mycontent = $value->description;
                                        $word = str_word_count(strip_tags($mycontent));
                                        $m = floor($word / 200);
                                        $s = floor($word % 200 / (200 / 60));
                                        $est = $m . ' minute' . ($m == 1 ? '' : 's');
                                        ?>

                                        {{ $est }}
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $article->links() }}
        </div>
    </section>

<!-- content-section-ends-here -->

    @include('home_layouts.modal')

@endsection





