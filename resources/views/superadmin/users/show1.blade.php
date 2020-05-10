@extends('layouts.default')

@section('title', 'Users')

@section('subheader', 'Users')
@section('subheader-link', route('users.index'))

@section('subheader-action', 'Show')

@section('pagevendorsstyles')
@endsection

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
                            <h3 class="kt-portlet__head-title">{{ $user->name }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:history.go(-1)" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <div class="btn-group">
                                <a href="{{ route('users.edit', $user)  }}" type="button" class="btn btn-brand"
                                   id="save-btn">
                                    <i class="la la-edit"></i>
                                    <span class="kt-hidden-mobile">Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form class="kt-form" id="user-form" action="{{ route('users.store') }}" method="POST">
                            @csrf
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
                                                    <input class="form-control" name="name" type="text"
                                                           placeholder="Full Name" value="{{ $user->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Email Address</label>
                                                <div class="col-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                class="input-group-text"><i
                                                                    class="la la-at"></i></span></div>
                                                        <input type="email" class="form-control"
                                                               name="email"
                                                               placeholder="Email"
                                                               value="{{ $user->email }}"
                                                               aria-describedby="basic-addon1" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Student ID</label>
                                                <div class="col-9">
                                                    <input class="form-control" name="student_id" type="text"
                                                           placeholder="P18000000" value="{{ $user->student_id }}"
                                                           disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">IC Number</label>
                                                <div class="col-9">
                                                    <input class="form-control" name="ic_number" type="text"
                                                           id="kt_inputmask_4" value="{{ $user->ic_number }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Phone Number</label>
                                                <div class="col-9">
                                                    <input class="form-control" name="phone_number" type="text"
                                                           value="{{ $user->phone_number }}" disabled>
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
                                                                    <input type="checkbox" name="email_verified"
                                                                           {{ $user->email_verified_at ? 'checked' : '' }} disabled>
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

@section('pagevendorsscripts')
@endsection

@section('pagescripts')
@endsection
