
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <meta property="og:title" content="{{ isset($single_article->title)?$single_article->title:'' }}" />
    <meta property="og:description" content="{{ isset($single_article->description)?$single_article->description:'' }}" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="{{ asset('article/',isset($single_article->image)?$single_article->image:'')  }}" />

    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="{{ asset('img/fabicon1.png') }}" type="image/x-icon" />


    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />

    <!-- Custom Theme files -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />

    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- for bootstrap working -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:600" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/responsiveslides.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin-theme/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin-theme/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $(function () {
            $("#slider").responsiveSlides({
                auto: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                pager: true,
            });
        });
    </script>

    {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>--}}


    <script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
    <!--/script-->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
            });
        });
    </script>

    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementcategoryById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=2520005324807291&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script src="{{ asset('assets/js/admin-theme/jquery.pjax.js') }}"></script>

</head>
<body>
<!-- header-section-starts-here -->
<div class="header">
    <div class="header-top">
        <div class="container wrap">
            <div class="top-menu">
                <ul>
                    <li><a href="{{ route('about_us') }}">About Us</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                </ul>
            </div>

            <div class="num" style="padding: 0px 10px">
                <?php
                    $user = \Illuminate\Support\Facades\Auth::user();
                    if(count($user) > 0) {
                        $role = \App\User::getUserRoleName($user);
                    }
                ?>

                @if(isset($role) && ($role == '' || $role == 'writter'))

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                           aria-haspopup="true"
                           style="font-size: 16px;font-family: 'Source Sans Pro', sans-serif;color: #fff;">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            {{ ucfirst(Auth::user()->first_name) }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu login">

                            <li>
                                <a href="{{ route('front.user.profile') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('user.article') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    My Article
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.bookmark.list') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                    Bookmark
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                     </li>
                @else
                    <li> <a href="" style="text-decoration: none;color: white;padding-right: 10px;padding-top: 6px;display: block" data-toggle="modal" data-target="#login">Login</a></li>
                    <li><a href="" style="text-decoration: none;color: white;padding-top: 6px;display: block" data-toggle="modal" data-target="#registration">Register</a></li>
                @endif
                <div class="search">
                    <!-- start search-->
                    <div class="search-box">
                        <div id="sb-search" class="sb-search">
                            <form action="{{ route('post_search') }}" method="GET">
                                <input class="sb-search-input" placeholder="Enter your search term..." type="text" name="search" id="search">
                                <input class="sb-search-submit" type="submit" value="">
                                <span class="sb-icon-search"> <i class="fa fa-search" aria-hidden="true"></i> </span>
                            </form>
                        </div>
                    </div>
                    <!-- search-scripts -->
                    <script src="{{ asset('js/classie.js') }}"></script>
                    <script src="{{ asset('js/uisearch.js') }}"></script>
                    <script>
                        new UISearch( document.getElementById( 'sb-search' ) );
                    </script>
                    <!-- //search-scripts -->
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>



    @if(session()->has('msg'))
        <div class="alert alert-success">
            {{ session()->get('msg') }}
        </div>
    @endif

    <div class="header-bottom">
        <div class="logo text-center">
            <a href="{{ route('front.home') }}"><img src="{{ asset('img/logo1.png') }}" alt="" width="250px" height="100px" /></a>
        </div>
        <div class="navigation">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container wrap">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <!--/.navbar-header-->

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">

                            <li class="active"><a href="{{ route('front.home') }}" style="font-size: 15px">Home</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 15px">Category<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @foreach($category as $value)
                                        <li><a style="font-size: 14px;padding: 9px;" href="{{ route('category_by_post',$value->id) }}">{{ $value->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a style="font-size: 15px" href="">About Us</a></li>

                            <li><a style="font-size: 15px" href="">Contact Us</a></li>

                            <div class="clearfix"></div>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--/.navbar-collapse-->
                <!--/.navbar-->
            </nav>
        </div>
    </div>
    <!-- header-section-ends-here -->



    @yield('content')



<!-- footer-section-starts-here -->
    <div class="footer">
        <div class="footer-top">
            <div class="container wrap ">
                <div class="row">
                    <div class="col-md-6 col-xs-6 col-sm-4 footer-grid">
                        <h4 class="footer-head">About Us</h4>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here.</p>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-2 footer-grid">
                        <h4 class="footer-head">Categories</h4>
                        <ul class="cat">
                            @foreach($category as $value)
                                <li><a href="{{ route('category_by_post',$value) }}">{{ ucfirst($value->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4 col-xs-12 footer-grid">
                        <h4 class="footer-head">Contact Us</h4>
                        <span class="hq">Our headquaters</span>
                        <address>
                            <ul class="location">
                                <li><span class="glyphicon glyphicon-map-marker"></span></li>
                                <li>House # 4 (5th Floor), Road # 20 <br>
                                    Nikunja – 2, Dhaka <br>
                                    1229 Bangladesh</li>
                                <div class="clearfix"></div>
                            </ul>
                            <ul class="location">
                                <li><span class="glyphicon glyphicon-earphone"></span></li>
                                <li>+880 2 8900235</li>
                                <div class="clearfix"></div>
                            </ul>
                            <ul class="location">
                                <li><span class="glyphicon glyphicon-envelope"></span></li>
                                <li><a href="mailto:info@example.com">sales@exclusivewebservices.net</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container wrap">
                <div class="copyrights col-md-6">
                    <p> © 2015 Express News. All Rights Reserved | Design by  <a href="{{ URL::to('/') }}"> Shojibul Islam</a></p>
                </div>
                <div class="footer-social-icons col-md-6">
                    <ul>
                        <li><a class="facebook" href="#"></a></li>
                        <li><a class="twitter" href="#"></a></li>
                        <li><a class="flickr" href="#"></a></li>
                        <li><a class="googleplus" href="#"></a></li>
                        <li><a class="dribbble" href="#"></a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $.pjax.defaults.timeout = 50000
    </script>
    <!-- footer-section-ends-here -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
            wrapID: 'toTop', // fading element id
            wrapHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
            */
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>

    <a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <!---->
</div>
</body>
</html>
