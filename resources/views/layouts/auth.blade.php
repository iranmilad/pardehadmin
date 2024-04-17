<!DOCTYPE html>
<html data-bs-theme="light" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @vite(['resources/css/style-rtl.css'])
    @vite(['resources/plugins/global/plugins.bundle.rtl.css'])
    @vite(['resources/css/app.css'])
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getآیتم("data-bs-theme") !== null) {
					themeMode = localStorage.getآیتم("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<div class="d-flex flex-column flex-root" id="kt_app_root">

		<div class="d-flex flex-column flex-center flex-column-fluid">

			<div class="d-flex flex-column flex-center text-center p-10">

				<div class="card card-flush w-lg-650px py-5">
					<div class="card-body">
						<!--begin::Logo-->
						<div class="">
							<a href="/" class="">
								<img alt="Logo" src="/images/logo.svg" class="h-150px" />
							</a>
						</div>
						<!--end::Logo-->
						<!--begin::Title-->
						<h1 class="fw-bolder text-gray-900 mb-7">@yield("title")</h1>
						<!--end::Counter-->
						<!--begin::Text-->
						<!--end::Text-->
						<!--begin::Form-->
                        @yield('content')

						<!--end::Illustration-->
					</div>
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Authentication - Signup Welcome Message-->
	</div>
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--end::سفارشی Javascript-->
    <script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('js/scripts.bundle.js')}}"></script>
    <script src="{{asset('js/widgets.bundle.js')}}"></script>
    <script src="{{asset('js/custom/widgets.js')}}"></script>
    @vite("resources/js/app.js")
    @yield('scripts')
    <!--end::Javascript-->
</body>

</html>