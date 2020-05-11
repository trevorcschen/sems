@extends('layouts.default')

@section('title', 'Communities')

@section('subheader', 'Communities')
@section('subheader-link', route('communities.index'))

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
                            <h3 class="kt-portlet__head-title">Create New Community
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
                        <form class="kt-form" id="community-form" action="{{ route('communities.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Community
                                                Info:</h3>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Community Logo</label>
                                                <div class="col-9">
                                                    <div class="kt-uppy @error('logo_path') is-invalid @enderror" id="kt_uppy_3">
                                                        <div class="kt-uppy__drag"></div>
                                                        <div class="kt-uppy__informer"></div>
                                                        <div class="kt-uppy__progress"></div>
                                                        <div class="kt-uppy__thumbnails"></div>
                                                    </div>
                                                    @error('logo_path')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <span class="form-text text-muted">
                                                        Leave this blank if you do not wish to set the community image.
                                                    </span>
                                                    <input type="hidden" name="logo_path" id="logo_path" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Community Name</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                           name="name" type="text" placeholder="Community Name" maxlength="80"
                                                           value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Description</label>
                                                <div class="col-9">
                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" maxlength="200">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Membership Fee</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('fee') is-invalid @enderror" type="number" name="fee" step="0.01" value="{{ old('fee') }}">
                                                    @error('fee')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <span class="form-text text-muted">
                                                        Put zero if you want joining fee to be free.
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Maximum members</label>
                                                <div class="col-9">
                                                    <input class="form-control @error('max_members') is-invalid @enderror" type="number" name="max_members" value="{{ old('max_members') }}">
                                                    @error('max_members')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--last">
                                                <div class="kt-section__body">
                                                    <h3 class="kt-section__title kt-section__title-lg">Community Activation:</h3>
                                                    <div class="form-group row">
                                                        <label class="col-3 col-form-label">Community Active</label>
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
                                                                                Community is active and students can join.
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
                                                                                Community is not active and students are unable to join.
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--last">
                                                <div class="kt-section__body">
                                                    <h3 class="kt-section__title kt-section__title-lg">Community Admin:</h3>
                                                    <div class="form-group row">
                                                        <label class="col-3 col-form-label">Admin</label>
                                                        <div class="col-9">
                                                            <select class="form-control kt-select2 @error('admin') is-invalid @enderror" id="admin-select" name="admin">
                                                                <option></option>
                                                            </select>
                                                            @error('admin')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
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
@endsection

@section('pagescripts')
    <script>
        "use strict";

        function formatRepo(user) {
            if (user.loading) return user.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'><strong>" + user.name + "</strong></div>" +
                "<div class='select2-result-repository__description'><i class='fa fa-male'></i> Student ID: <strong>" + user.student_id + "</strong></div>" +
                "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-address-card'></i> IC: <strong>" + user.ic_number + "</strong></div>" +
                "<div class='select2-result-repository__stargazers'><i class='fa fa-mail-bulk'></i> Email: <strong>" + user.email + "</strong></div>" +
                "</div>" +
                "</div></div>";
            return markup;
        }

        function formatRepoSelection (user) {
            return user.name || user.text;
        }

        var Select2 = {
            init: function() {
                $("#admin-select").select2({
                    placeholder: "Search for users",
                    allowClear: true,
                    ajax: {
                        url: "{{ route('ajax.users.search') }}",
                        dataType: "json",
                        delay: 250,
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: function(params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            }
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.data,
                                pagination: {
                                    more: (params.page * 5) < data.total
                                }
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function(markup) {
                        return markup
                    },
                    minimumInputLength: 1,
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                })
            }
        };

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
                        $('#logo_path').val(value.response.body.image_path);
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
                            image_path: $('#logo_path').val(),
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
                            $("#logo_path").val('');
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
                $( "#community-form" ).validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 80,
                        },
                        description: {
                            required: true,
                            maxlength: 200
                        },
                        fee: {
                            required: true,
                        },
                        max_members: {
                            required: true,
                            min: 1,
                        },
                        admin: {
                            required: true,
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
                $("#community-form").submit(); // Submit the form
            });

            KTUppy.init();
            Select2.init();
            KTFormControls.init();
        });

    </script>
@endsection
