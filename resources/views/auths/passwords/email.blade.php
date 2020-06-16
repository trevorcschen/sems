@extends('layouts.auth')

@section('title', 'Forgotten Password ?')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/css/pages/login/login-3.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--forgot" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg') }});">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="{{ asset('assets/media/logos/inti-logo.png') }}" width="300px" height="50px">
                            </a>
                        </div>
                        <div class="kt-login__forgot">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Forgotten Password ?</h3>
                                <div class="kt-login__desc">Enter your email to reset your password:</div>
                            </div>
                            <form class="kt-form" id="forgot-form" method="POST" action="{{ route('password.email') }}">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <div class="alert-text">{{ session('status') }}</div>
                                        <div class="alert-close">
                                            <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                                        </div>
                                    </div>
                                @endif
                                @csrf
                                <div class="input-group">
                                    <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" id="kt_email" autocomplete="off" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('Send Password Reset Link') }}</button>&nbsp;&nbsp;
                                    <a href="{{ route('login') }}" id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">{{ __('Login') }}</a>
                                </div>
                            </form>
                        </div>
                        @if (Route::has('register'))
                            <div class="kt-login__account">
                                    <span class="kt-login__account-msg">
                                        Don't have an account yet ?
                                    </span>
                                &nbsp;&nbsp;
                                <a href="{{ route('register') }}" id="kt_login_signup" class="kt-login__account-link">{{ __('Register') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagevendorsscripts')
@endsection

@section('pagescripts')
    <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}" type="text/javascript"></script>
@endsection
