@php
use Illuminate\Support\Facades\Vite;
@endphp

<!DOCTYPE html>
<html data-bs-theme="light" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @yield('css-before')
    <link rel="stylesheet" href="{{asset('css/style-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/global/plugins.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/global/plugins.bundle.rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/flatpickr-custom.css')}}">
    @vite(['resources/css/app.css'])
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <!--end::Theme mode setup on page load-->
    <!--begin::اپلیکیشن-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('partials.header')
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    <!--begin::Logo-->
                    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                        <!--begin::Logo image-->
                        <a href="{{route('index')}}">
                            <img alt="Logo" src="/images/logo.svg" class="h-100px app-sidebar-logo-default" />
                            <img alt="Logo" src="/images/logo.svg" class="h-100px app-sidebar-logo-minimize" />
                        </a>
                        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <!--end::Sidebar toggle-->
                    </div>
                    <!--end::Logo-->
                    <!--begin::sidebar menu-->
                    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                        <!--begin::Menu wrapper-->
                        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                            @include('partials.navbar')
                        </div>
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::sidebar menu-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        @yield('title')
                                    </h1>
                                    <!--end::Title-->
                                    <x-breadcrumb />
                                </div>
                                <!--end::Page title-->
                                @yield("toolbar")
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @yield("content")

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                </div>
                <!--end:::Main-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Modals-->
    <!--begin::Javascript-->
    <!--end::سفارشی Javascript-->

    <script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('js/scripts.bundle.js')}}"></script>
    <script src="{{asset('js/widgets.bundle.js')}}"></script>
    <script src="{{asset('js/custom/widgets.js')}}"></script>
    <script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script src="{{asset('plugins/flatpickr.min.js')}}"></script>
    @yield('script-before')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let advanced_search = window['advanced_search'] = $('.advanced_search').select2({
                placeholder: "جستجو کنید",
                language: {
                    inputTooShort: function() {
                        return "حداقل باید 3 حرف وارد کنید"
                    },
                    noResults: function() {
                        return "نتیجه ای یافت نشد";
                    },
                    searching: function() {
                        return "در حال جستجو...";
                    }
                },
                ajax: {
                    url: function(params) {
                        return window.ajaxUrl + "?type=" + $(this).data('type') + "&q=" + params.term;
                    },
                    dataType: 'json',
                    delay: 250,
                },
                minimumInputLength: 3
            });
        })

        function fmSetLink($url) {
            let btn = window['choose_file'];
            if (btn) {
                if (btn.classList.contains('path1') || btn.classList.contains('preview-image-label')) {
                    if (btn.classList.contains('path1')) {
                        const closestImageWrapper = btn.parentElement.parentElement.parentElement.querySelector('.image-input-wrapper');
                        if (closestImageWrapper) {
                            window['changethatBg'](closestImageWrapper, $url);
                        }
                    } else {
                        const siblingImageWrapper = btn.parentElement.querySelector('.image-input-wrapper');
                        if (siblingImageWrapper) {
                            window['changethatBg'](siblingImageWrapper, $url);
                        }
                    }
                } else if (btn.classList.contains('choose_file_button')) {
                    btn.parentElement.parentElement.querySelector('input').value = $url;
                } else if (btn.hasAttribute("data-add-multiple-type")) {
                    window['preview_multi'](btn, $url)
                }
            }
            if(window['uploader-type'] === "ckeditor"){
                window['ckeditor_file']($url)
            }
        }
        document.addEventListener("DOMContentLoaded", () => {
            window.addEventListener('message', event => {
                if (event.origin === new URL(document.referrer).origin) {
                    alert(event.data);
                }
            });
            if ($(".multiple_file_repeater").length > 0) {
                $(".multiple_file_repeater").repeater({
                    initEmpty: false,
                    show: function() {
                        $(this).show();
                        window['KT_File_Input']();
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            }
        })
    </script>
    @vite("resources/js/app.js")
    @yield('scripts')
    @livewireScripts
    <!--end::Javascript-->




</body>

</html>
