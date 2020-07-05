<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->

    <!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
    </div>
    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


        <!--begin: Search -->
        <!--end: Search -->

        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown ">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand notification_item_icon">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
												<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
											</g>
										</svg> <span class="kt-pulse__ring"></span>
                                          <span class="badge badge-notify" style="display :{{auth()->user()->unreadnotifications->count() ? 'block' : 'none'}}">{{auth()->user()->unreadnotifications->count()}}</span> <!-- badge count here -->
									</span>

                <!--
    Use dot badge instead of animated pulse effect:
    <span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>
-->
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                <form>

                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">
                        <h3 class="kt-head__title">
                            Notifications
                            &nbsp;</h3>
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">New Notifications</a>
                            </li>
                        </ul>
                    </div>

                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                @foreach(auth()->user()->notifications as $notification)
                                    <div class="containerAction">
                                    <a href="{{ $notification->data['permit'] == 1 ? ($notification->data['routing'] == 'user' ? route('users.show', $notification->data['routingID']) : ($notification->data['routing'] == 'commi' ?route('commi.community',$notification->data['routingID']) :route('event.show',$notification->data['routingID']))) : 'javascript:void(0)' }}" class="kt-notification__item {{$notification->read_at == null ? null : 'kt-notification__item--read'}}" id="{{$notification->id}}">
{{--                                    <a href="javascript:void(0)" class="kt-notification__item {{$notification->read_at == null ? null : 'kt-notification__item--read'}}" id="{{$notification->id}}">--}}
                                                                            <div class="kt-notification__item-icon">
                                                                                <i class="flaticon2-safe kt-font-primary"></i>
                                                                            </div>
                                                                            <div class="kt-notification__item-details">
                                                                                <div class="kt-notification__item-title">
                                                                                    {{$notification->data['data']}}
                                                                                </div>

                                                                                <div class="kt-notification__item-time">
                                                                                    {{\Carbon\Carbon::parse($notification->updated_at)->diffForHumans()}}
                                                                                </div>

                                                                            </div>
                                                                        </a>
                                        @if($notification->data['action'] == 1)
                                            <div class="actionNotification" style="display: flex;flex-direction: row;justify-content: space-around;margin-top: 5px" id="{{$notification->id}}">
                                                <button type="button" class="btn btn-decline" style="background: rgba(255, 0, 0, 0.08);color: red;">Decline</button>
                                                <button type="button" class="btn btn-accept" style="background-color: rgba(153, 255, 160, 0.5);color: green;">Accept</button>
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end: Notifications -->

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    @auth
                        <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>
                        @if(Auth::user()->profile_image_path)
                            <img alt="Pic" src="{{ Storage::url(Auth::user()->profile_image_path) }}" />
                        @else
                            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ Auth::user()->name_acronym }}</span>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">
                    <div class="kt-user-card__avatar">
                        @auth
                            @if(Auth::user()->profile_image_path)
                                <img alt="Pic" src="{{ Storage::url(Auth::user()->profile_image_path) }}" />
                            @else
                                <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ Auth::user()->name_acronym }}</span>
                            @endif
                        @endauth
                    </div>
                    <div class="kt-user-card__name">
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    </div>
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="{{ route('profiles.show') }}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Profile
                            </div>
                            <div class="kt-notification__item-time">
                                Account settings and more
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
{{--  --}}

</div>
