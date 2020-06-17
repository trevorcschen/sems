@extends('layouts.default')

@section('title', 'Users')

@section('subheader', 'Users')
@section('subheader-link', route('users.index'))

@section('subheader-action', 'Create')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />
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
                            <h3 class="kt-portlet__head-title">Create New User
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
                                                <label class="col-3 col-form-label">Profile Image</label>
                                                <div class="col-9">
                                                    <div class="kt-uppy @error('profile_image_path') is-invalid @enderror" id="kt_uppy_3">
                                                        <div class="kt-uppy__drag"></div>
                                                        <div class="kt-uppy__informer"></div>
                                                        <div class="kt-uppy__progress"></div>
                                                        <div class="kt-uppy__thumbnails"></div>
                                                    </div>
                                                    @error('profile_image_path')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <span class="form-text text-muted">
                                                        Leave this blank if you do not wish to set the profile image.
                                                    </span>
                                                    <input type="hidden" name="profile_image_path" id="profile_image_path" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Full Name</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                           name="name" type="text" placeholder="Full Name" maxlength="80"
                                                           value="{{ old('name') }}">
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
                                                               value="{{ old('email') }}"
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
                                                        name="student_id" type="text" placeholder="Student ID"
                                                        value="{{ old('student_id') }}">
                                                    @error('student_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">IC Number</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('ic_number') is-invalid @enderror"
                                                           name="ic_number" type="text" placeholder="IC Number" id="kt_inputmask_4"
                                                           value="{{ old('ic_number') }}">
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
                                                        name="phone_number" type="text" placeholder="Phone Number"
                                                        value="{{ old('phone_number') }}">
                                                    @error('phone_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Biography</label>
                                                <div class="col-9">
                                                    <textarea class="form-control @error('biography') is-invalid @enderror" name="biography" placeholder="Biography" rows="3" maxlength="200">{{ old('biography') }}</textarea>
                                                    @error('biography')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Password</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('password') is-invalid @enderror"
                                                           name="password" id="password" placeholder="Password" type="password">
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
                                                        name="password_confirmation" placeholder="Confirm Password" type="password">
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
                                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                                                                                <input type="radio" name="active" value="1" checked>
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
                                                                                <input type="radio" name="active" value="0">
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
                                                                    <input type="checkbox" name="email_verified"> Email
                                                                    is verified.
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
    <script src="{{ asset('assets/plugins/custom/uppy/uppy.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/input-mask.js') }}" type="text/javascript"></script>
@endsection

@section('pagescripts')
    <script>
        var KTUppy = function () {
            const XHR = Uppy.XHRUpload;
            const ProgressBar = Uppy.ProgressBar;
            const StatusBar = Uppy.StatusBar;
            const FileInput = Uppy.FileInput;
            const Informer = Uppy.Informer;

            var initUppy3 = function(){
                var id = '#kt_uppy_3';

                var uppyDrag = Uppy.Core({
                    autoProceed: true,
                    restrictions: {
                        maxFileSize: 1000000, // 1mb
                        maxNumberOfFiles: 1,
                        minNumberOfFiles: 1,
                        allowedFileTypes: ['image/*']
                    }
                });

                uppyDrag.use(Uppy.DragDrop, { target: id + ' .kt-uppy__drag' });
                uppyDrag.use(ProgressBar, {
                    target: id + ' .kt-uppy__progress',
                    hideUploadButton: false,
                    hideAfterFinish: false
                });
                uppyDrag.use(Informer, { target: id + ' .kt-uppy__informer'  });
                uppyDrag.use(XHR, {
                    endpoint: '{{ route('files.images.store') }}',
                    method: 'POST',
                    fieldName: 'file',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });

                uppyDrag.on('complete', function(file) {
                    var imagePreview = "";
                    $.each(file.successful, function(index, value){
                        var imageType = /image/;
                        var thumbnail = "";
                        if (imageType.test(value.type)){
                            thumbnail = '<div class="kt-uppy__thumbnail"><img src="'+value.uploadURL+'"/></div>';
                        }
                        var sizeLabel = "bytes";
                        var filesize = value.size;
                        if (filesize > 1024){
                            filesize = filesize / 1024;
                            sizeLabel = "kb";
                            if(filesize > 1024){
                                filesize = filesize / 1024;
                                sizeLabel = "MB";
                            }
                        }
                        $('#profile_image_path').val(value.response.body.image_path);
                        imagePreview += '<div class="kt-uppy__thumbnail-container" data-id="'+value.id+'">'+thumbnail+' <span class="kt-uppy__thumbnail-label">'+value.name+' ('+ Math.round(filesize, 2) +' '+sizeLabel+')</span><span data-id="'+value.id+'" class="kt-uppy__remove-thumbnail"><i class="flaticon2-cancel-music"></i></span></div>';
                    });

                    $(id + ' .kt-uppy__thumbnails').append(imagePreview);
                });

                $(document).on('click', id + ' .kt-uppy__thumbnails .kt-uppy__remove-thumbnail', function(){
                    var imageId = $(this).attr('data-id');

                    $.ajax({
                        url: '{{ route('files.images.destroy') }}',
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: {
                            image_path: $('#profile_image_path').val(),
                        },
                        error: function() {
                            $.notify({
                                icon: 'glyphicon glyphicon-warning-sign',
                                message: 'An error has occurred',
                            }, { type: 'danger'});
                        },
                        success: function(data) {
                            uppyDrag.removeFile(imageId);
                            $(id + ' .kt-uppy__thumbnail-container[data-id="'+imageId+'"').remove();
                            $("#profile_image_path").val('');
                        },
                    });
                });
            }

            return {
                init: function() {
                    initUppy3();
                }
            };
        }();

        var KTFormControls = function () {
            var formValidation = function () {
                $( "#user-form" ).validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 80,
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
                        biography: {
                            required: true,
                            maxlength: 200
                        },
                        password: {
                            required: true,
                            minlength: 16,
                        },
                        password_confirmation: {
                            required: true,
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

        $(document).ready(function () {
            $("#save-btn").click(function () {
                $("#user-form").submit();
            });

            KTUppy.init();
            KTFormControls.init();
        });
    </script>
@endsection
