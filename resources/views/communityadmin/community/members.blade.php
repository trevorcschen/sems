@extends('layouts.default')

@section('title', $community->name)

@section('subheader', $community->name)
@section('subheader-link', route('home'))

@section('subheader-action', '')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/viewerjs/viewer.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/lists.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @if(Session::has('message'))
            <div class="alert alert-success  show" role="alert">
                <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                <div class="alert-text">
                    <strong>
                        Well done! {{Session::get('message')}}.
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
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
                                            @if(empty($community->logo_path))
                                                <i class="kt-font-brand flaticon2-line-chart"></i>
                                            @else
                                                <img src="storage/images/community/{{$community->id}}/{{$community->logo_path}}" style="width: 32px;height: 32px;" />
                                            @endif
										</span>
                    <h3 class="kt-portlet__head-title">
                        @yield('subheader')
                    </h3>
                </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{route('commi.community', $community->id)}}" style="right: 20px" class="btn btn-brand btn-elevate btn-icon-sm" >
                                    <i class="la la-backward"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="list list-row block">
                                    @foreach($community->users as $user)
                                    <div class="list-item">
                                        <div><a href="{{route('users.show', $user->id)}}" data-abc="true"><span class="w-48 avatar gd-info">{{$user->name_acronym}}</span></a></div>
                                        <div class="flex"> <a href="{{route('users.show', $user->id)}}" class="item-author text-color" data-abc="true">{{$user->name}}</a>
                                            <div class="item-except text-muted text-sm h-1x">{{$user->email}}</div>
                                            <div class="item-except text-muted text-sm h-1x">{{$user->biography}}</div>
                                        </div>
{{--                                        <div class="no-wrap">--}}
{{--                                            <div class="item-date text-muted text-sm d-none d-md-block">{{$u}}</div>--}}
{{--                                        </div>--}}
                                    </div>
                                        @endforeach

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="flex-event-right-container" style="flex: 2;">
                                    <div class="card" >
                                        <div class="card-body">
                                            <h4 class="card-title">Community Admin </h4>
                                            <div style="display: flex;flex-direction: row;">
                                                <div class="image-container">
                                                    <img src="https://image.flaticon.com/icons/svg/2971/2971373.svg" style="height: 64px;width: 64px;"/>
                                                </div>

                                                <div class="community-details-container" style="margin-left: 10px;margin-top: 5px">
                                                    <p class="card-text">{{$community->admin->name}}</p>
                                                    <a href="{{route('commi.members', $community)}}" class="card-text">{{ number_format($community->users->count()) }}/{{$community->max_members}} Members</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="margin-top: 20px">
                                        <div class="card-body">
                                            <h4 class="card-title">Community Description </h4>
                                            <p class="card-text">{{substr($community->description, 0, 100)}}
                                                @if(strlen($community->description ) > 100)
                                                    <a href="javascript:void(0)" id="dots" style="color: blue;opacity: 1;display: block">Read More</a><span id="more" style="display: none">{{substr($community->description, 100)}}</span></p>
                                                   @endif
                                            <div class="kt-widget__subhead" style="display: flex;justify-content: space-around">
                                                <a href="#" onclick="return false;" title="Created at {{date_format($community->created_at, 'd M Y')}}"><i class="flaticon-calendar" style="padding-right: 10px"></i>{{date_format($community->created_at, 'd M Y')}}</a>
                                                <a href="#" onclick="return false;" title="Updated at {{date_format($community->updated_at, 'd M Y')}}"><i class="flaticon2-pen" style="padding-right: 10px"></i>{{date_format($community->updated_at, 'd M Y')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
            </div>
            </div>
        </div>
        @endsection
@section('pagescripts')
    <script type="text/javascript">
        const dotsClick = document.querySelector('#dots');
        dotsClick.addEventListener('click', function()
        {
            document.querySelector('#dots').style.display = 'none';
            document.querySelector('#more').style.display = 'block';
        })

    </script>
    @endsection

