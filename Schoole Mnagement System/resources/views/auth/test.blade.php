@extends('layouts.signin_page')
<link rel="stylesheet"  href="/assets/vendors/bootstrap-5.1.3/css/bootstrap.min.css}}">

<!--Custom css-->
<link rel="stylesheet"  href="/assets/css/main.css}}">
<link rel="stylesheet"  href="/assets/css/style.css}}">

<link rel="stylesheet"  href="/assets/vendors/bootstrap-icons-1.8.1/bootstrap-icons.css}}">

<!--Toaster css-->
<link rel="stylesheet"  href="/assets/css/toastr.min.css}}"/>
@section('content')

    <style>

        .login-image{
            width: inherit;
            height: 100%;
            position: fixed;
            background-image: url("/public/assets/images/login.png");
            background-size: cover;
            background-position: center;
        }

    </style>

    <div class="row h-100">
        <div class="col-lg-6 d-none d-lg-block p-0 h-100">
            <div class="bg-image login-image">
            </div>
        </div>
        <div class="col-lg-6 p-0 h-100 position-relative">
            <div class="parent-elem">
                <div class="middle-elem">
                    <div class="primary-form">
                        <div class="form-logo mb-5">
                            <img height="60px" src="#">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="login-form">
                                    <form method="post" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input type="email" name="email" class="form-control" id="email"
                                                           placeholder="Your email address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                    <input type="password" name="password" class="form-control border-end" id="password"
                                                           placeholder="Input your password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="w-100 d-flex justify-content-end">
{{--                                                    <a href="{{ route('password.request') }}" class="float-end">{{ __('Forgot password') }}</a>--}}
                                                    <i class="bi bi-record-fill text-5px mx-1 px-1"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
