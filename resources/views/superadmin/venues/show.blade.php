@extends('layouts.default')

@section('title', 'Venues')

@section('subheader', 'Venues')
@section('subheader-link', route('venues.index'))

@section('subheader-action', 'Show')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/viewerjs/viewer.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                @if($venue->venue_image_path)
                                    <div class="kt-widget__media kt-hidden-">
                                        <img src="{{ Storage::url($venue->venue_image_path) }}" id="venue_image" alt="image">
                                    </div>
                                @else
                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                                        {{ $venue->name_acronym }}
                                    </div>
                                @endif
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" onclick="return false;" class="kt-widget__username">
                                            {{ $venue->name }}
                                            @if($venue->active)
                                                <i class="flaticon2-correct" title="Active"></i>
                                            @else
                                                <i class="flaticon2-correct text-danger" title="Inactive"></i>
                                            @endif
                                        </a>
                                        <div class="kt-widget__action">
                                            <button type="button" class="btn btn-label-danger btn-sm btn-upper" data-toggle="modal" data-target="#modal-delete" data-id="{{ $venue->id }}"><i class="la la-trash"></i>Delete</button>&nbsp;
                                            <a href="{{ route('venues.edit', $venue) }}" class="btn btn-brand btn-sm btn-upper"><i class="la la-edit"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#" onclick="return false;" title="Created at {{ $venue->created_at->format('l, F j, Y h:i:s A') }}"><i class="flaticon-calendar"></i>{{ $venue->created_at->format('F j, Y') }}</a>
                                        <a href="#" onclick="return false;" title="Updated at {{ $venue->updated_at->format('l, F j, Y h:i:s A') }}"><i class="flaticon2-pen"></i>{{ $venue->updated_at->format('F j, Y') }}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc" style="width: 100px;overflow-wrap: break-word;" title="Description">
                                            {{ $venue->description }}
                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="kt-widget__text" >
                                                Usage Rate
                                            </div>
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $venue->usage_rate }}%;" aria-valuenow="{{ $venue->usage_rate }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="kt-widget__stats">
                                                {{ $venue->usage_rate }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-network"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Capacity</span>
                                        <span class="kt-widget__value">{{ number_format($venue->capacity) }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-presentation"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Air Conditioned</span>
                                        <span class="kt-widget__value">{{ $venue->air_conditioned ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-users"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Events Conducted</span>
                                        <span class="kt-widget__value">{{ number_format($venue->events->count()) }}</span>

                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Communities Used</span>
                                        <span class="kt-widget__value">{{ number_format($venue->events->unique('community_id')->count()) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile3-->
            </div>
        </div>

        <!--End::Section-->
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete permanently?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>The record and all its associated data will deleted.</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection

@section('pagevendorsscripts')
    <script src="{{ asset('assets/plugins/viewerjs/viewer.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-viewer/jquery-viewer.min.js') }}" type="text/javascript"></script>
@endsection

@section('pagescripts')
    <script>
        var $image = $('#venue_image');
        $image.viewer();

        $('#modal-delete').on('show.bs.modal', function (e) {
            var url = '{{ route("venues.destroy", ':id') }}';
            url = url.replace(':id', $(e.relatedTarget).data('id'));
            $(this).find('form').attr('action', url);
        });
    </script>
@endsection
