@extends('layouts.default')

@section('title', 'Venues')

@section('subheader', 'Venues')
@section('subheader-link', route('venues.index'))

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
                            <h3 class="kt-portlet__head-title">{{ $venue->name }}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:history.go(-1)" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <div class="btn-group">
                                <a href="{{ route('venues.edit', $venue)  }}" type="button" class="btn btn-brand"
                                   id="save-btn">
                                    <i class="la la-edit"></i>
                                    <span class="kt-hidden-mobile">Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form class="kt-form" id="venue-form" action="{{ route('venues.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Venue
                                                Info:</h3>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Venue Name</label>
                                                <div class="col-9">
                                                    <input class="form-control"
                                                           name="name" type="text" placeholder="Venue Name"
                                                           value="{{ $venue->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Capacity (persons)</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="number" name="capacity" value="{{ $venue->capacity }}" disabled>
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
