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
        @if (session('success'))
            <div class="alert alert-success fade show" role="alert">
                <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                <div class="alert-text">
                    <strong>
                        Well done!
                    </strong>
                    {!! session('success') !!}
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        @endif

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                @if($community->logo_path)
                                    <div class="kt-widget__media kt-hidden-">
                                        <img src="{{ Storage::url($community->logo_path) }}" id="community_logo" alt="image">
                                    </div>
                                @else
                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                                        {{ $community->name_acronym }}
                                    </div>
                                @endif
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" onclick="return false;" class="kt-widget__username">
                                            {{ $community->name }}
                                            @if($community->active)
                                                <i class="flaticon2-correct" title="Active"></i>
                                            @else
                                                <i class="flaticon2-correct text-danger" title="Inactive"></i>
                                            @endif
                                        </a>
                                        <div class="kt-widget__action">
                                            @role('student')
                                                @if(!$community->users->contains(Auth::user()->id))
                                                    <button type="button" class="btn btn-brand btn-sm btn-upper" data-toggle="modal" data-target="#modal-join" data-id="{{ $community->id }}"><i class="la la-plus"></i>Join</button>&nbsp;
                                                @else
                                                    <button type="button" class="btn btn-brand btn-sm btn-upper" disabled><i class="la la-plus"></i>Joined</button>&nbsp;
                                                @endif
                                            @endrole
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#" onclick="return false;" title="Founded at {{ $community->created_at->format('l, F j, Y h:i:s A') }}"><i class=" flaticon-calendar"></i>{{ $community->created_at->format('F j, Y') }}</a>
                                        <a href="#" onclick="return false;" title="Updated at {{ $community->updated_at->format('l, F j, Y h:i:s A') }}"><i class=" flaticon-calendar"></i>{{ $community->updated_at->format('F j, Y') }}</a>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#" onclick="return false;" title="Community Admin"><i class="flaticon-profile-1"></i>{{ $community->admin->name }}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc" style="width: 100px;overflow-wrap: break-word;" title="Description">
                                            {{ $community->description }}
                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="kt-widget__text" >
                                                Membership Rate
                                            </div>
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $community->membership_rate }}%;" aria-valuenow="{{ $community->membership_rate }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="kt-widget__stats">
                                                {{ number_format($community->membership_rate, 2, '.', ',') }}%
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
                                        <span class="kt-widget__title">Members</span>
                                        <span class="kt-widget__value">{{ number_format($community->users->count()) }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-presentation"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Events</span>
                                        <span class="kt-widget__value">{{ number_format($community->events->count()) }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-users"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Membership Fee</span>
                                        <span class="kt-widget__value">{{ $community->fee == 0 ? 'Free' :  'RM ' .number_format($community->fee, 2, '.', ',') }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Maximum Members</span>
                                        <span class="kt-widget__value">{{ number_format($community->max_members) }}</span>
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
    <div class="modal fade" id="modal-join" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Join?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-brand">Confirm Join</button>
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
        var $image = $('#community_logo');
        $image.viewer();

        $('#modal-join').on('show.bs.modal', function (e) {
            var url = '{{ route("communities.join", ':id') }}';
            url = url.replace(':id', $(e.relatedTarget).data('id'));
            $(this).find('form').attr('action', url);
        });
    </script>
@endsection
