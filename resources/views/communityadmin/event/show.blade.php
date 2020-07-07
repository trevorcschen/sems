@extends('layouts.default')

@section('title', 'Event')

@section('subheader', 'Users')
{{--@section('subheader-link', route('users.index'))--}}

@section('subheader-action', 'Show')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/viewerjs/viewer.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/lists.css') }}" rel="stylesheet" type="text/css"/>
@endsection
<style>
    .borderList
    {
        margin-top: 50px;
        border-top: 1px groove rgba(103, 102, 102, 0.19);
    }
</style>

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                             id="kt_page_portlet">

                        <div class="kt-widget kt-widget--user-profile-3">

                            <div class="kt-widget__top">
{{--                                @if($event->image_URL)--}}
{{--                                    <div class="kt-widget__media kt-hidden-">--}}
{{--                                        <img src="{{ Storage::url($event->image_URL) }}" id="profile_image" alt="image">--}}
{{--                                    </div>--}}
{{--                                @else--}}
                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light text-center">
                                        {{ $event->name }}
                                    </div>
{{--                                @endif--}}
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" onclick="return false;" class="kt-widget__username">
                                            {{ $event->name }}
                                            @if($event->active)
                                                <i class="flaticon2-correct" title="Active"></i>
                                            @else
                                                <i class="flaticon2-correct text-danger" title="Inactive"></i>
                                            @endif
                                        </a>
                                        @hasrole('student')
                                            <div class="kt-widget__action">
                                                @if(!$event->users->contains(Auth::user()->id))
                                                    <button type="button" class="btn btn-brand btn-sm btn-upper" data-toggle="modal" data-target="#modal-join" data-id="{{ $event->id }}"><i class="la la-plus"></i>Join</button>&nbsp;
                                                @else
                                                    <button type="button" class="btn btn-brand btn-sm btn-upper" disabled><i class="la la-plus"></i>Joined</button>&nbsp;
                                                @endif
                                            </div>
                                        @endhasrole
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#" onclick="return false;" title="Created at {{ $event->created_at->format('l, F j, Y h:i:s A') }}"><i class="flaticon-calendar"></i>{{ $event->created_at->format('F j, Y') }}</a>
                                        <a href="#" onclick="return false;" title="Updated at {{ $event->updated_at->format('l, F j, Y h:i:s A') }}"><i class="flaticon2-pen"></i>{{ $event->updated_at->format('F j, Y') }}</a>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#" onclick="return false;" title="User Role"><i class="flaticon-user-ok"></i>Event Organizer</a>
                                        <a href="#" onclick="return false;" title="Student ID"><i class=" flaticon-profile-1"></i>{{$event->user->student_id}}</a>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#" onclick="return false;" title="Email"><i class="flaticon2-new-email"></i>{{$event->user->email}}</a>
                                        <a href="#" onclick="return false;" title="Phone Number"><i class="flaticon2-phone"></i>{{$event->user->phone_number}}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc" style="width: 100px;overflow-wrap: break-word;" title="Event Description">
                                            {{$event->description}}
                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="kt-widget__text">
                                                Participant Rate
                                            </div>
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" title="{{$event->percentage}}%" style="width: {{$event->percentage}}%" aria-valuenow="{{$event->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="kt-widget__stats">
                                                {{ $event->percentage }}%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget__info" style="flex-direction: row-reverse">
                                        <div class="kt-widget__progress" style="display: inline-block;text-align: center">
                                            <div class="kt-widget__text">
                                                {{$event->current_participants}} / {{$event->max_participants}} participated in this event
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Participants</span>
                                        <span class="kt-widget__value">{{$event->users->count()}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Event Request Submission Day</span>
                                        <span class="kt-widget__value">{{ substr(\Carbon\Carbon::parse($event->start_time)->subDays(1), 0, 10)}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Event Duration</span>
                                        <span class="kt-widget__value">{{substr($event->start_time, 0, 16)}} to {{substr($event->end_time, 0, 16)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row borderList">
                            <div class="col-sm-9">
                                <div class="list list-row block">
                                    @foreach($event->users as $user)
                                        <div class="list-item">
                                            <div><a href="{{route('users.show', $user->id)}}" data-abc="true"><span class="w-48 avatar gd-info">{{$user->name_acronym}}</span></a></div>
                                            <div class="flex"> <a href="{{route('users.show', $user->id)}}" class="item-author text-color" data-abc="true">{{$user->name}}</a>
                                                <div class="item-except text-muted text-sm h-1x">{{$user->email}}</div>
                                                <div class="item-except text-muted text-sm h-1x">{{$user->biography}}</div>
                                            </div>
                                        </div>
                                    @endforeach

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
        var $image = $('#profile_image');
        $image.viewer();

        $('#modal-join').on('show.bs.modal', function (e) {
            var url = '{{ route("event.join", ':id') }}';
            url = url.replace(':id', $(e.relatedTarget).data('id'));
            $(this).find('form').attr('action', url);
        });
    </script>
@endsection
