{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.auth')

@section('content')
    <style>
        .theme-btn {
            background-color: #4e23ee;
            color: white !important;
            border: 2px #4e23ee solid;
        }

        .theme-btn:hover {
            color: black;
            border: 2px #4e23ee solid;
        }
        .email,
        .password {
            border: 1px solid rgba(24, 113, 215, 0.88);
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        .title{
            font-family: 'Bebas Neue', sans-serif;
            color: #3c21a8;
            font-size: 40px;
            letter-spacing: 1.4px;
        }
    </style>
    <!-- Sing Up Area Start -->
    <section class="sign-up-page p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-5">
                    <div class="sign-up-left-content">
                        <p class="font-weight-bold mb-3 mt-5"> Welcome To The Best Site For Manage Your Learning...</p>
                        <div class="sign-up-bottom-img">
                            <img src="/frontend/login.png" alt="hero" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="sign-up-right-content bg-white">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h5 class="mt-0 mb-5 font-weight-bold title">{{__('Sign In')}}</h5>
                            {{--                            <p class="font-14 mb-30">{{__('New User')}} ? <a href="{{route('sign-up')}}" class="color-hover text-decoration-underline font-medium">{{__('Create an Account')}}</a></p>--}}

                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <label><p class="font-14 mb-1">{{__('Email or Phone')}}</p></label>
                                    <input type="text" name="email" class="form-control email" placeholder="{{ __('Type your email or phone number') }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-md-12">
                                    <label><p class="font-14 mb-1 mt-1">{{__('Password')}}</p></label>
                                    <div class="form-group mb-0 position-relative">
                                        <input class="form-control password" name="password" placeholder="*********" type="password">
                                        <span class="toggle cursor fas fa-eye pass-icon"></span>
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-30">
                                <div class="col-md-12"><a href="#" class="color-hover text-decoration-underline font-medium">{{__('Forgot Password')}}?</a></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100 sign_up">{{__('Sign In')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sing Up Area End -->
@endsection

