@extends('layouts.default')

@section('title', 'Communities')

@section('subheader', 'Communities')
@section('subheader-link', route('communities.index'))

@section('subheader-action', 'Show')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/viewerjs/viewer.min.css') }}" rel="stylesheet" type="text/css"/>
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
                            <h3 class="kt-portlet__head-title">{{ $community->name }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:history.go(-1)" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <div class="btn-group">
                                <a href="{{ route('communities.edit', $community) }}" type="button" class="btn btn-brand"
                                   id="save-btn">
                                    <i class="la la-edit"></i>
                                    <span class="kt-hidden-mobile">Edit</span>
                                </a>
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
                                                <label class="col-3 col-form-label">Community Name</label>
                                                <div class="col-9">
                                                    <input class="form-control"
                                                           name="name" type="text" placeholder="Community Name"
                                                           value="{{ $community->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Description</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="description" rows="3" disabled>{{ $community->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <input type="hidden" name="logo_path" id="logo_path" value="">
                                                <label class="col-3 col-form-label">Community Logo</label>
                                                <div class="col-9">
                                                    <div class="kt-section">
                                                        <div class="kt-section__content">
                                                            @if($community->logo_path)
                                                                <a id="image" class="kt-media kt-media--xl kt-media--circle">
                                                                    <img src="{{ Storage::url($community->logo_path) }}" alt="image">
                                                                </a>
                                                            @else
                                                                <a class="kt-media kt-media--xl kt-media--circle kt-media--info">
                                                                    <span>{{ $acronym }}</span>
                                                                </a>
                                                            @endif
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
                                                            <input class="form-control"
                                                                   name="name" type="text"
                                                                   value="{{ $community->admin->name }}" disabled>
                                                            </select>
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
    <script src="{{ asset('assets/plugins/viewerjs/viewer.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-viewer/jquery-viewer.min.js') }}" type="text/javascript"></script>
@endsection

@section('pagescripts')
    <script>
        var $image = $('#image');
        $image.viewer();
    </script>
@endsection
