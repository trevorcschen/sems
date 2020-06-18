@extends('layouts.auth')

@section('title', __('Register'))

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
                                <h3 class="kt-login__title">{{ __('Register') }}</h3>
                                <div class="kt-login__desc">Enter your details to create your account:</div>
                            </div>
                            <form class="kt-form" id="register-form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           name="name" type="text" placeholder="Full Name" maxlength="80"
                                           value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           placeholder="Email"
                                           value="{{ old('email') }}"
                                           aria-describedby="basic-addon1">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('student_id') is-invalid @enderror"
                                        name="student_id" type="text" placeholder="Student ID"
                                        value="{{ old('student_id') }}">
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input class="form-control @error('ic_number') is-invalid @enderror"
                                           name="ic_number" type="text" placeholder="IC Number" id="kt_inputmask_4"
                                           value="{{ old('ic_number') }}">
                                    @error('ic_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        name="phone_number" type="text" placeholder="Phone Number"
                                        value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" placeholder="Password" type="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" placeholder="Confirm Password" type="password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signup_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('Register') }}</button>&nbsp;&nbsp;
                                    <a href="{{ route('login') }}" id="kt_login_signup_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">{{ __('Login') }}</a>
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
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/input-mask.js') }}" type="text/javascript"></script>
@endsection
