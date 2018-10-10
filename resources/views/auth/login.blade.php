@extends('layouts.login')
@section('title')
    FingerWind | Login
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"  style="background-color:#308066;color: white;padding: 10px">{{ __('Login') }}</div>
                <br>
                <br>
                <br>
                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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


                        <div class="form-group row mb-0" style="margin-left: 245px">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>

                        <div class="text-center">
                            <!-- Add font awesome icons -->
                            <a href="" class="fa fa-facebook" style="padding: 10px 20px;background: #3B5998;color: white;text-decoration: none;font-size: 15px"></a>
                            <a href="{{ url('auth/twitter') }}" class="fa fa-twitter" style="padding: 10px 20px;background: #55ACEE;color: white;text-decoration: none;font-size: 15px"></a>
                            <a href="" class="fa fa-linkedin" style="padding: 10px 20px;background: #007bb5;color: white;text-decoration: none;font-size: 15px"></a>
                            <a href="{{ url('auth/google') }}" class="fa fa-google" style="padding: 10px 20px;background: #dd4b39;color: white;text-decoration: none;font-size: 15px"></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
