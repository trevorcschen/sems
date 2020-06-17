@extends('layouts.auth')

@section('title', 'Verification')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/css/pages/login/login-3.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signup" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg') }});">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="{{ asset('assets/media/logos/inti-logo.png') }}" width="300px" height="50px">
                            </a>
                        </div>
                        <div class="kt-login__signup">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">{{ __('Verify Your Email Address') }}</h3>
                                <div class="kt-login__desc">
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email, click the resend button below.') }}
                                </div>
                            </div>
                            @if (session('resent'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-text">{{ __('A fresh verification link has been sent to your email address.') }}</div>
                                    <div class="alert-close">
                                        <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                                    </div>
                                </div>
                            @endif
                            <form class="kt-form" id="register-form" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <div class="kt-login__actions">
                                    <button id="kt_login_signup_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('Resend') }}</button>&nbsp;&nbsp;
                                    <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-light btn-elevate kt-login__btn-secondary">{{ __('Logout') }}</a>
                                </div>
                            </form>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
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
