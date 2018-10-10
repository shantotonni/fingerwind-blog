
@extends('home_layouts.master')

@section('title')
    FingerWind | Contact US Page
@endsection

@section('content')

    <!-- content-section-starts-here -->
    <div class="main-body">
        <div class="container wrap">
            <div class="col-md-12 content-left">
                <div class="articles">
                    <header>
                        <h3 class="title-head">Contact Us</h3>
                    </header>

                    <div class="contact_grid">
                        <div class="col-md-8 contact-top">
                            <div class="alert alert-danger print_error_message" style="display: none">
                                <ul></ul>
                            </div>
                            <form action="{{ route('contact.form.store') }}" method="post" class="contact_form">
                                <div class="to">
                                    <input type="text" class="text" placeholder="Please Enter Your Name" name="name">
                                    <input type="text" class="text" placeholder="Please Enter Your Email" name="email" style="margin-left:20px">
                                    <input type="text" class="text" placeholder="Please Enter Your Subject" name="subject">
                                </div>
                                <div class="text">
                                    <textarea name="description" placeholder="Please write Somethings" rows="10"></textarea>
                                </div>
                                <div class="form-submit1">
                                    <input name="submit" type="submit" id="submit" value="Submit Your Message"><br>
                                </div>
                                <div class="clearfix"> </div>
                            </form>
                        </div>
                        <div class="col-md-4 contact-top_right">
                            <h3 style="color: #257E56">contact info</h3>
                            <address>
                                <ul class="location">
                                    <li><span class="glyphicon glyphicon-map-marker"></span></li>
                                    <li>234 Kirkman Ave, Elmont, NY 11003 .<br></li>
                                    <div class="clearfix"></div>
                                </ul>
                                <ul class="location">
                                    <li><span class="glyphicon glyphicon-earphone"></span></li>
                                    <li>516-216-5709</li>
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
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- content-section-ends-here -->
    @include('home_layouts.modal')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).delegate('.contact_form','submit',function (e) {
            e.preventDefault();

            var data=$(this).serialize();
            $.ajax({

                url: $(this).attr('action'),
                type: 'POST',
                data: data,
                success: function (data) {

                    console.log(data);
                    data = jQuery.parseJSON(data);
                    if(data.result == 'success'){
                        toastr.success(data.message);
                    }else{

                        errorMessageShow(data.message);
                    }
                }
            });
            return false;
        });

        function errorMessageShow(msg) {

        $('.print_error_message').find('ul').empty();
        $('.print_error_message').css('display','block');

        $.each(msg,function (key,value) {

            $('.print_error_message').find('ul').append("<li>" + value + "<li>");

            })

        }

    </script>

@endsection





