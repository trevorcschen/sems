@extends('layouts.default')

@section('title', 'Home')

@section('subheader', 'Home')
@section('subheader-link', route('home'))

@section('subheader-action', '')

@section('pagevendorsstyles')
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 1-->

        <!--Begin::Row-->
        <div class="row">
            <div class="col-lg-12 col-xl-12 order-lg-12 order-xl-12">

                @role('super-admin')
                    <!--begin:: Widgets/Activity-->
                    <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                        <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Statistics (Last 7 days)
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-widget17">
                                <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                                    <div class="kt-widget17__chart" style="height:320px;">
                                        <canvas id="kt_chart_activities"></canvas>
                                    </div>
                                </div>
                                <div class="kt-widget17__stats">
                                    <div class="kt-widget17__items">
                                        <div class="kt-widget17__item">
                                                                <span class="kt-widget17__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                        </g>
                                                                    </svg> </span>
                                            <span class="kt-widget17__subtitle">
                                                                    Users
                                                                </span>
                                            <span class="kt-widget17__desc">
                                                                    {{ $widget['userCount'] }} Total Users
                                                                </span>
                                        </div>
                                        <div class="kt-widget17__item">
                                                                <span class="kt-widget17__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                                                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                        </g>
                                                                    </svg> </span>
                                            <span class="kt-widget17__subtitle">
                                                                    Communities
                                                                </span>
                                            <span class="kt-widget17__desc">
                                                                    {{ $widget['communityCount'] }} Total Communites
                                                                </span>
                                        </div>
                                    </div>
                                    <div class="kt-widget17__items">
                                        <div class="kt-widget17__item">
                                                                <span class="kt-widget17__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path d="M10.1573188,15.7101991 C10.7319317,15.871464 11.3373672,15.9576401 11.9626774,15.9576401 C12.5879876,15.9576401 13.1934231,15.871464 13.768036,15.7101991 L14.2784001,17.0884863 C14.2961491,17.1364191 14.3052407,17.1871941 14.3052407,17.2383863 C14.3052407,17.4741652 14.1165055,17.6653018 13.8836889,17.6653018 L12.805781,17.6381197 C12.8616756,18.8258731 13.2941654,19.508499 14.4169144,19.8875104 C14.8586529,20.0366301 15.0973861,20.5201716 14.95014,20.9675305 C14.8028938,21.4148895 14.3254274,21.6566602 13.8836889,21.5075406 C12.072317,20.8960676 11.1784281,19.5883144 11.1216188,17.6653018 L10.041666,17.6653018 C9.99111686,17.6653018 9.94097984,17.6560945 9.89364924,17.6381197 C9.67565622,17.5553322 9.56520732,17.309253 9.6469547,17.0884863 L10.1573188,15.7101991 Z" fill="#000000" fill-rule="nonzero"/>
                                                                            <path d="M12,16 C8.13400675,16 5,12.8659932 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.8659932 15.8659932,16 12,16 Z M8.81595773,8.80077353 C8.79067542,8.43921955 8.47708263,8.16661749 8.11552864,8.19189981 C7.75397465,8.21718213 7.4813726,8.53077492 7.50665492,8.89232891 C7.62279197,10.5531661 8.39667037,11.8635466 9.79502238,12.7671393 C10.099435,12.9638458 10.5056723,12.8765328 10.7023788,12.5721203 C10.8990854,12.2677077 10.8117724,11.8614704 10.5073598,11.6647638 C9.4559885,10.9853845 8.90327706,10.0494981 8.81595773,8.80077353 Z" fill="#000000" opacity="0.3"/>
                                                                        </g>
                                                                    </svg> </span>
                                            <span class="kt-widget17__subtitle">
                                                                    Events
                                                                </span>
                                            <span class="kt-widget17__desc">
                                                                    {{ $widget['eventCount'] }} Total Events
                                                                </span>
                                        </div>
                                        <div class="kt-widget17__item">
                                                                <span class="kt-widget17__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--danger">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                                                                        </g>
                                                                    </svg> </span>`
                                            <span class="kt-widget17__subtitle">
                                                                    Venues
                                                                </span>
                                            <span class="kt-widget17__desc">
                                                                    {{ $widget['venueCount'] }} Total Users
                                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Activity-->
                @else
                    @role('community-admin')
                        <!--begin:: Widgets/Activity-->
                        <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                            <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Activity (Last 7 days)
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <div class="kt-widget17">
                                    <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                                        <div class="kt-widget17__chart" style="height:320px;">
                                            <canvas id="kt_chart_activities_student"></canvas>
                                        </div>
                                    </div>
                                    <div class="kt-widget17__stats">
                                        <div class="kt-widget17__items">
                                            <div class="kt-widget17__item">
                                                            <span class="kt-widget17__icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    </g>
                                                                </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                                Communities
                                                            </span>
                                                <span class="kt-widget17__desc">
                                                                {{ $widget['communityCount'] }} Total Communites
                                                            </span>
                                            </div>
                                            <div class="kt-widget17__item">
                                                            <span class="kt-widget17__icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path d="M10.1573188,15.7101991 C10.7319317,15.871464 11.3373672,15.9576401 11.9626774,15.9576401 C12.5879876,15.9576401 13.1934231,15.871464 13.768036,15.7101991 L14.2784001,17.0884863 C14.2961491,17.1364191 14.3052407,17.1871941 14.3052407,17.2383863 C14.3052407,17.4741652 14.1165055,17.6653018 13.8836889,17.6653018 L12.805781,17.6381197 C12.8616756,18.8258731 13.2941654,19.508499 14.4169144,19.8875104 C14.8586529,20.0366301 15.0973861,20.5201716 14.95014,20.9675305 C14.8028938,21.4148895 14.3254274,21.6566602 13.8836889,21.5075406 C12.072317,20.8960676 11.1784281,19.5883144 11.1216188,17.6653018 L10.041666,17.6653018 C9.99111686,17.6653018 9.94097984,17.6560945 9.89364924,17.6381197 C9.67565622,17.5553322 9.56520732,17.309253 9.6469547,17.0884863 L10.1573188,15.7101991 Z" fill="#000000" fill-rule="nonzero"/>
                                                                        <path d="M12,16 C8.13400675,16 5,12.8659932 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.8659932 15.8659932,16 12,16 Z M8.81595773,8.80077353 C8.79067542,8.43921955 8.47708263,8.16661749 8.11552864,8.19189981 C7.75397465,8.21718213 7.4813726,8.53077492 7.50665492,8.89232891 C7.62279197,10.5531661 8.39667037,11.8635466 9.79502238,12.7671393 C10.099435,12.9638458 10.5056723,12.8765328 10.7023788,12.5721203 C10.8990854,12.2677077 10.8117724,11.8614704 10.5073598,11.6647638 C9.4559885,10.9853845 8.90327706,10.0494981 8.81595773,8.80077353 Z" fill="#000000" opacity="0.3"/>
                                                                    </g>
                                                                </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                                Events
                                                            </span>
                                                <span class="kt-widget17__desc">
                                                                {{ $widget['eventCount'] }} Total Events
                                                            </span>
                                            </div>
                                        </div>
                                        <div class="kt-widget17__items">
                                            <div class="kt-widget17__item">
                                                        <span class="kt-widget17__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                </g>
                                                            </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                            Communities Managed
                                                        </span>
                                                <span class="kt-widget17__desc">
                                                            {{ $widget['communityManagedCount'] }} Communites
                                                        </span>
                                            </div>
                                            <div class="kt-widget17__item">
                                                            <span class="kt-widget17__icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--danger">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path d="M10.1573188,15.7101991 C10.7319317,15.871464 11.3373672,15.9576401 11.9626774,15.9576401 C12.5879876,15.9576401 13.1934231,15.871464 13.768036,15.7101991 L14.2784001,17.0884863 C14.2961491,17.1364191 14.3052407,17.1871941 14.3052407,17.2383863 C14.3052407,17.4741652 14.1165055,17.6653018 13.8836889,17.6653018 L12.805781,17.6381197 C12.8616756,18.8258731 13.2941654,19.508499 14.4169144,19.8875104 C14.8586529,20.0366301 15.0973861,20.5201716 14.95014,20.9675305 C14.8028938,21.4148895 14.3254274,21.6566602 13.8836889,21.5075406 C12.072317,20.8960676 11.1784281,19.5883144 11.1216188,17.6653018 L10.041666,17.6653018 C9.99111686,17.6653018 9.94097984,17.6560945 9.89364924,17.6381197 C9.67565622,17.5553322 9.56520732,17.309253 9.6469547,17.0884863 L10.1573188,15.7101991 Z" fill="#000000" fill-rule="nonzero"/>
                                                                        <path d="M12,16 C8.13400675,16 5,12.8659932 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.8659932 15.8659932,16 12,16 Z M8.81595773,8.80077353 C8.79067542,8.43921955 8.47708263,8.16661749 8.11552864,8.19189981 C7.75397465,8.21718213 7.4813726,8.53077492 7.50665492,8.89232891 C7.62279197,10.5531661 8.39667037,11.8635466 9.79502238,12.7671393 C10.099435,12.9638458 10.5056723,12.8765328 10.7023788,12.5721203 C10.8990854,12.2677077 10.8117724,11.8614704 10.5073598,11.6647638 C9.4559885,10.9853845 8.90327706,10.0494981 8.81595773,8.80077353 Z" fill="#000000" opacity="0.3"/>
                                                                    </g>
                                                                </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                                Events Managed
                                                            </span>
                                                <span class="kt-widget17__desc">
                                                                {{ $widget['eventManagedCount'] }} Events
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Activity-->
                    @else
                        <!--begin:: Widgets/Activity-->
                        <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                            <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Activity (Last 7 days)
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <div class="kt-widget17">
                                    <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                                        <div class="kt-widget17__chart" style="height:320px;">
                                            <canvas id="kt_chart_activities_student"></canvas>
                                        </div>
                                    </div>
                                    <div class="kt-widget17__stats">
                                        <div class="kt-widget17__items">
                                            <div class="kt-widget17__item">
                                                        <span class="kt-widget17__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                </g>
                                                            </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                            Communities
                                                        </span>
                                                <span class="kt-widget17__desc">
                                                            {{ $widget['communityCount'] }} Total Communites
                                                        </span>
                                            </div>
                                            <div class="kt-widget17__item">
                                                        <span class="kt-widget17__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M10.1573188,15.7101991 C10.7319317,15.871464 11.3373672,15.9576401 11.9626774,15.9576401 C12.5879876,15.9576401 13.1934231,15.871464 13.768036,15.7101991 L14.2784001,17.0884863 C14.2961491,17.1364191 14.3052407,17.1871941 14.3052407,17.2383863 C14.3052407,17.4741652 14.1165055,17.6653018 13.8836889,17.6653018 L12.805781,17.6381197 C12.8616756,18.8258731 13.2941654,19.508499 14.4169144,19.8875104 C14.8586529,20.0366301 15.0973861,20.5201716 14.95014,20.9675305 C14.8028938,21.4148895 14.3254274,21.6566602 13.8836889,21.5075406 C12.072317,20.8960676 11.1784281,19.5883144 11.1216188,17.6653018 L10.041666,17.6653018 C9.99111686,17.6653018 9.94097984,17.6560945 9.89364924,17.6381197 C9.67565622,17.5553322 9.56520732,17.309253 9.6469547,17.0884863 L10.1573188,15.7101991 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M12,16 C8.13400675,16 5,12.8659932 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.8659932 15.8659932,16 12,16 Z M8.81595773,8.80077353 C8.79067542,8.43921955 8.47708263,8.16661749 8.11552864,8.19189981 C7.75397465,8.21718213 7.4813726,8.53077492 7.50665492,8.89232891 C7.62279197,10.5531661 8.39667037,11.8635466 9.79502238,12.7671393 C10.099435,12.9638458 10.5056723,12.8765328 10.7023788,12.5721203 C10.8990854,12.2677077 10.8117724,11.8614704 10.5073598,11.6647638 C9.4559885,10.9853845 8.90327706,10.0494981 8.81595773,8.80077353 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                            Events
                                                        </span>
                                                <span class="kt-widget17__desc">
                                                            {{ $widget['eventCount'] }} Total Events
                                                        </span>
                                            </div>
                                        </div>
                                        <div class="kt-widget17__items">
                                            <div class="kt-widget17__item">
                                                    <span class="kt-widget17__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                            </g>
                                                        </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                        Communities Joined
                                                    </span>
                                                <span class="kt-widget17__desc">
                                                        {{ $widget['communityJoinedCount'] }} Communites
                                                    </span>
                                            </div>
                                            <div class="kt-widget17__item">
                                                        <span class="kt-widget17__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--danger">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M10.1573188,15.7101991 C10.7319317,15.871464 11.3373672,15.9576401 11.9626774,15.9576401 C12.5879876,15.9576401 13.1934231,15.871464 13.768036,15.7101991 L14.2784001,17.0884863 C14.2961491,17.1364191 14.3052407,17.1871941 14.3052407,17.2383863 C14.3052407,17.4741652 14.1165055,17.6653018 13.8836889,17.6653018 L12.805781,17.6381197 C12.8616756,18.8258731 13.2941654,19.508499 14.4169144,19.8875104 C14.8586529,20.0366301 15.0973861,20.5201716 14.95014,20.9675305 C14.8028938,21.4148895 14.3254274,21.6566602 13.8836889,21.5075406 C12.072317,20.8960676 11.1784281,19.5883144 11.1216188,17.6653018 L10.041666,17.6653018 C9.99111686,17.6653018 9.94097984,17.6560945 9.89364924,17.6381197 C9.67565622,17.5553322 9.56520732,17.309253 9.6469547,17.0884863 L10.1573188,15.7101991 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M12,16 C8.13400675,16 5,12.8659932 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.8659932 15.8659932,16 12,16 Z M8.81595773,8.80077353 C8.79067542,8.43921955 8.47708263,8.16661749 8.11552864,8.19189981 C7.75397465,8.21718213 7.4813726,8.53077492 7.50665492,8.89232891 C7.62279197,10.5531661 8.39667037,11.8635466 9.79502238,12.7671393 C10.099435,12.9638458 10.5056723,12.8765328 10.7023788,12.5721203 C10.8990854,12.2677077 10.8117724,11.8614704 10.5073598,11.6647638 C9.4559885,10.9853845 8.90327706,10.0494981 8.81595773,8.80077353 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg> </span>
                                                <span class="kt-widget17__subtitle">
                                                            Events Joined
                                                        </span>
                                                <span class="kt-widget17__desc">
                                                            {{ $widget['eventJoinedCount'] }} Events
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Activity-->
                    @endrole
                @endrole
            </div>
        </div>
        <!--End::Row-->
        <!--End::Dashboard 1-->
    </div>
@endsection

@section('pagevendorsscripts')
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>
@endsection

@section('pagescripts')
    <script>
        "use strict";

        // Class definition
        var KTDashboard = function() {

            // Activities Charts.
            // Based on Chartjs plugin - http://www.chartjs.org/
            var activitiesChart = function() {
                if ($('#kt_chart_activities').length == 0) {
                    return;
                }

                var ctx = document.getElementById("kt_chart_activities").getContext("2d");

                var gradient = ctx.createLinearGradient(0, 0, 0, 240);
                gradient.addColorStop(0, Chart.helpers.color('#e14c86').alpha(1).rgbString());
                gradient.addColorStop(1, Chart.helpers.color('#e14c86').alpha(0.3).rgbString());

                let dates = [];
                let newUserCounts = [];

                $.get("{{ route('ajax.home.chart') }}", function(response) {
                    dates = Object.keys(response).reverse();
                    newUserCounts = Object.values(response).reverse() ;
                    var config = {
                        type: 'line',
                        data: {
                            labels: dates,
                            datasets: [{
                                label: "New users",
                                backgroundColor: Chart.helpers.color('#e14c86').alpha(1).rgbString(),  //gradient
                                borderColor: '#e13a58',

                                pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor('light'),
                                pointHoverBorderColor: Chart.helpers.color('#ffffff').alpha(0.1).rgbString(),

                                //fill: 'start',
                                data: newUserCounts,
                            }]
                        },
                        options: {
                            title: {
                                display: false,
                            },
                            tooltips: {
                                mode: 'nearest',
                                intersect: false,
                                position: 'nearest',
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {
                                display: false
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                xAxes: [{
                                    display: false,
                                    gridLines: false,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Date'
                                    }
                                }],
                                yAxes: [{
                                    display: false,
                                    gridLines: false,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Value'
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            elements: {
                                line: {
                                    tension: 0.0000001
                                },
                                point: {
                                    radius: 4,
                                    borderWidth: 12
                                }
                            },
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                    top: 10,
                                    bottom: 80
                                }
                            }
                        }
                    };

                    var chart = new Chart(ctx, config);
                });
            }

            var activitiesChartStudent = function() {
                if ($('#kt_chart_activities_student').length == 0) {
                    return;
                }

                var ctx = document.getElementById("kt_chart_activities_student").getContext("2d");

                var gradient = ctx.createLinearGradient(0, 0, 0, 240);
                gradient.addColorStop(0, Chart.helpers.color('#e14c86').alpha(1).rgbString());
                gradient.addColorStop(1, Chart.helpers.color('#e14c86').alpha(0.3).rgbString());

                let dates = [];
                let newUserCounts = [];

                $.get("{{ route('ajax.home.chart') }}", function(response) {
                    dates = Object.keys(response).reverse();
                    newUserCounts = Object.values(response).reverse() ;
                    console.log(dates);
                    console.log(newUserCounts);

                    var config = {
                        type: 'line',
                        data: {
                            labels: dates,
                            datasets: [{
                                label: "New events",
                                backgroundColor: Chart.helpers.color('#e14c86').alpha(1).rgbString(),  //gradient
                                borderColor: '#e13a58',

                                pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                                pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                                pointHoverBackgroundColor: KTApp.getStateColor('light'),
                                pointHoverBorderColor: Chart.helpers.color('#ffffff').alpha(0.1).rgbString(),

                                //fill: 'start',
                                data: newUserCounts,
                            }]
                        },
                        options: {
                            title: {
                                display: false,
                            },
                            tooltips: {
                                mode: 'nearest',
                                intersect: false,
                                position: 'nearest',
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: {
                                display: false
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                xAxes: [{
                                    display: false,
                                    gridLines: false,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Date'
                                    }
                                }],
                                yAxes: [{
                                    display: false,
                                    gridLines: false,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Value'
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            elements: {
                                line: {
                                    tension: 0.0000001
                                },
                                point: {
                                    radius: 4,
                                    borderWidth: 12
                                }
                            },
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                    top: 10,
                                    bottom: 80
                                }
                            }
                        }
                    };

                    var chart = new Chart(ctx, config);
                });
            }


            return {
                // Init demos
                init: function() {
                    // init charts
                    activitiesChart();
                    activitiesChartStudent();
                }
            };
        }();

        // Class initialization on page load
        jQuery(document).ready(function() {
            KTDashboard.init();
        });

    </script>
@endsection
