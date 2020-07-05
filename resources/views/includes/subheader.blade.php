<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="toast-container" style="position: fixed; bottom: 100px; right: 0">
        </div>
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">@yield('title')</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="@yield('subheader-link')" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                @hasSection('subheader-action')
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="javascript:void(0)" class="kt-subheader__breadcrumbs-link">
                    @yield('subheader-action')
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
