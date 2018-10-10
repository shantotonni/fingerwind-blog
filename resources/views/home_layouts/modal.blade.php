<!-- Login modal-->
<div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #43bc86">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.login') }}">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row mb-0" style="margin-left: 200px">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        <br>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>

                    {{--<div class="text-center">--}}
                        {{--<!-- Add font awesome icons -->--}}
                        {{--<a href="" class="fa fa-facebook" style="padding: 10px 20px;background: #3B5998;color: white;text-decoration: none;font-size: 15px"></a>--}}
                        {{--<a href="{{ url('auth/twitter') }}" class="fa fa-twitter" style="padding: 10px 20px;background: #55ACEE;color: white;text-decoration: none;font-size: 15px"></a>--}}
                        {{--<a href="{{ url('auth/linkedin') }}" class="fa fa-linkedin" style="padding: 10px 20px;background: #007bb5;color: white;text-decoration: none;font-size: 15px"></a>--}}
                        {{--<a href="{{ url('auth/google') }}" class="fa fa-google" style="padding: 10px 20px;background: #dd4b39;color: white;text-decoration: none;font-size: 15px"></a>--}}
                    {{--</div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Registration modal-->

<div class="modal fade" id="registration" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #43bc86">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registration</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger registration_error_massage" style="display:none">
                    <ul></ul>
                </div>
                <div class="alert alert-success" style="display:none">
                    <p>Registration Successfully Completed ! Please Check Email and Active Your Email</p>
                </div>

                <div class="alert alert-dangerr" style="display:none">
                    <p>Registration Not Completed ! Your Email Already Used in this website.Please apply another email</p>
                </div>

                <form method="post" action="{{ route('user.registration') }}" class="register_form">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">
                                    First Name
                                </label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">
                                    Last Name
                                </label>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">
                                    Email
                                </label>
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">
                                    Password
                                </label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">
                                    Phone
                                </label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">
                                    Address
                                </label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    <br>
                    <br>
                    {{--<div class="text-center">--}}
                        {{--<!-- Add font awesome icons -->--}}
                        {{--<a href="" class="fa fa-facebook" style="padding: 10px 20px;background: #3B5998;color: white;text-decoration: none;font-size: 15px"></a>--}}
                        {{--<a href="{{ url('auth/twitter') }}" class="fa fa-twitter" style="padding: 10px 20px;background: #55ACEE;color: white;text-decoration: none;font-size: 15px"></a>--}}
                        {{--<a href="{{ url('auth/linkedin') }}" class="fa fa-linkedin" style="padding: 10px 20px;background: #007bb5;color: white;text-decoration: none;font-size: 15px"></a>--}}
                        {{--<a href="{{ url('auth/google') }}" class="fa fa-google" style="padding: 10px 20px;background: #dd4b39;color: white;text-decoration: none;font-size: 15px"></a>--}}
                    {{--</div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).delegate('.register_form','submit',function (e) {
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

                    $('#registration').modal('hide')
                    toastr.success(data.message);
                }else{

                    errorMessageShow(data.message);
                }

            }

        });
        return false;
    });

    function errorMessageShow(msg) {

        $('.registration_error_massage').find('ul').empty();
        $('.registration_error_massage').css('display','block');

        $.each(msg,function (key,value) {

            $('.registration_error_massage').find('ul').append("<li>" + value + "<li>");
        })
    }

</script>
