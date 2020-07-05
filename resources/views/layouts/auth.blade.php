<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
@include('includes.head')
<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
@yield('content')
<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
{{--@include('includes.globalconfig')--}}
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
@yield('pagevendorsscripts')
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
@yield('pagescripts')
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
