@extends('layouts.default')

@section('title', 'Users')

@section('subheader', 'Users')
@section('subheader-link', route('users.index'))

@section('subheader-action', 'Update')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                @if ($errors->any())
                    <div class="alert alert-danger fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">
                            <strong>
                                Whoops!
                            </strong>
                            There were some problems with your input. <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                     id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Update User Info
                                <small>Fill in the details below</small>
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:history.go(-1)" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-brand" id="save-btn">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form class="kt-form" id="user-form" action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">User
                                                Info:</h3>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Full Name</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                           name="name" type="text" placeholder="Full Name"
                                                           value="{{ $user->name }}">
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Email Address</label>
                                                <div class="col-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                class="input-group-text"><i
                                                                    class="la la-at"></i></span></div>
                                                        <input type="email"
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               name="email"
                                                               placeholder="Email"
                                                               value="{{ $user->email }}"
                                                               aria-describedby="basic-addon1">
                                                        @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Student ID</label>
                                                <div class="col-9">
                                                    <input
                                                        class="form-control @error('student_id') is-invalid @enderror"
                                                        name="student_id" type="text" placeholder="P18000000"
                                                        value="{{ $user->student_id }}">
                                                    @error('student_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">IC Number</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('ic_number') is-invalid @enderror"
                                                           name="ic_number" type="text" id="kt_inputmask_4"
                                                           value="{{ $user->ic_number }}">
                                                    @error('ic_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Phone Number</label>
                                                <div class="col-9">
                                                    <input
                                                        class="form-control @error('phone_number') is-invalid @enderror"
                                                        name="phone_number" type="text"
                                                        value="{{ $user->phone_number }}">
                                                    @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Password</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('password') is-invalid @enderror"
                                                           name="password" id="password" type="password">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Confirm Password</label>
                                                <div class="col-9">
                                                    <input
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation" type="password">
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--last">
                                                <div class="kt-section__body">
                                                    <h3 class="kt-section__title kt-section__title-lg">User Role Assignment:</h3>
                                                    <div class="form-group row">
                                                        <label class="col-3 col-form-label">User Role</label>
                                                        <div class="col-9">
                                                            <select class="form-control" name="role">
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>{{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--last">
                                                <div class="kt-section__body">
                                                    <h3 class="kt-section__title kt-section__title-lg">User Activation:</h3>
                                                    <div class="form-group row">
                                                        <label class="col-3 col-form-label">User Active</label>
                                                        <div class="col-9">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <label class="kt-option">
                                                                        <span class="kt-option__control">
                                                                            <span class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                <input type="radio" name="active" value="1" {{ $user->active ? 'checked' : '' }}>
                                                                                <span></span>
                                                                            </span>
                                                                        </span>
                                                                        <span class="kt-option__label">
                                                                            <span class="kt-option__head">
                                                                                <span class="kt-option__title">
                                                                                    Active
                                                                                </span>
                                                                            </span>
                                                                            <span class="kt-option__body">
                                                                                User is active and can login.
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="kt-option">
                                                                        <span class="kt-option__control">
                                                                            <span class="kt-radio kt-radio--bold kt-radio--brand">
                                                                                <input type="radio" name="active" value="0" {{ !$user->active ? 'checked' : '' }}>
                                                                                <span></span>
                                                                            </span>
                                                                        </span>
                                                                        <span class="kt-option__label">
                                                                            <span class="kt-option__head">
                                                                                <span class="kt-option__title">
                                                                                    Inactive
                                                                                </span>
                                                                            </span>
                                                                            <span class="kt-option__body">
                                                                                User is not active and unable to login.
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--last">
                                                <div class="kt-section__body">
                                                    <h3 class="kt-section__title kt-section__title-lg">Email
                                                        Verification:</h3>
                                                    <div class="form-group row">
                                                        <label class="col-3 col-form-label">Email verified</label>
                                                        <div class="col-9">
                                                            <div class="kt-checkbox-single">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"
                                                                           name="email_verified" {{ $user->email_verified_at ? 'checked' : '' }} >
                                                                    Email is verified.
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            <span class="form-text text-muted">
                                                            By checking this box, no email confirmation will be made to validate the email.
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')

    <script src="{{ asset('assets/js/pages/crud/forms/widgets/input-mask.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            $("#save-btn").click(function () {
                $("#user-form").submit(); // Submit the form
            });
        });

        var KTFormControls = function () {
            var formValidation = function () {
                $( "#user-form" ).validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        student_id: {
                            required: true,
                            pattern: '^[P][0-9]{1,8}?$',
                        },
                        ic_number: {
                            required: true,
                            pattern: '(([[1-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))-([0-9]{2})-([0-9]{4})'
                        },
                        phone_number: {
                            required: true,
                            pattern: '^(01)[0-46-9]*[0-9]{7,8}$'
                        },
                        password: {
                            minlength: 16,
                        },
                        password_confirmation: {
                            minlength: 16,
                            equalTo: '#password'
                        }
                    },
                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        swal.fire({
                            "title": "",
                            "text": "There are some errors in your submission. Please correct them.",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary",
                        });

                        event.preventDefault();
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            }

            return {
                init: function() {
                    formValidation();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTFormControls.init();
        });
    </script>
@endsection
