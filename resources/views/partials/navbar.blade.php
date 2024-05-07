<!--begin::Menu-->
<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true">
	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{ route('index') }}" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-grid-2"></i>
			</span>
			<span class="menu-title">پیشخوان</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-memo"></i>
			</span>
			<span class="menu-title">نوشته ها</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('posts') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه نوشته</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('post') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن نوشته</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('post-categories') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">دسته ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="../../demo1/dist/dashboards/online-courses.html">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">برچسب ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="../../demo1/dist/dashboards/marketing.html">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">دیدگاه ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-file"></i>
			</span>
			<span class="menu-title">برگه ها</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('page.list') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه برگه ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="../../demo1/dist/dashboards/ecommerce.html">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن برگه جدید</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item">
		<!--begin:Menu link-->
		<a href="/slides" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-folder-open"></i>
			</span>
			<span class="menu-title">مدیریت فایل ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-store"></i>
			</span>
			<span class="menu-title">محصولات</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="../../demo1/dist/index.html">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه ی محصولات</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{route('product.create.show')}}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن محصول جدید</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{route('product.categories.show')}}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">دسته بندی ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{route('product.tags.show')}}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">برچسب ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{route('attributes.list.show')}}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">ویژگی ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="../../demo1/dist/dashboards/ecommerce.html">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">دیدگاه ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="/" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-bags-shopping"></i>
			</span>
			<span class="menu-title">سفارش ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('user/*') ? 'show' : ''}}">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-badge-percent"></i>
			</span>
			<span class="menu-title">تخفیف ها</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('users.list') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه ی تخفیف ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('user.create') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن تخفیف جدید</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!-- end:Menu item -->

	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{ route('slides') }}" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-rectangle-history"></i>
			</span>
			<span class="menu-title">اسلاید ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->
	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item">
		<!--begin:Menu link-->
		<a href="/slides" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-messages"></i>
			</span>
			<span class="menu-title">پیام ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('user/*') ? 'show' : ''}}">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-user"></i>
			</span>
			<span class="menu-title">کاربران</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('users.list') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه ی کاربران</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('user.create') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن کاربر جدید</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!-- end:Menu item -->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-money-check-dollar"></i>
			</span>
			<span class="menu-title">چک ها</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('users.list') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه ی چک ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('user.create') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن چک برای کاربر</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!-- end:Menu item -->



	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item">
		<!--begin:Menu link-->
		<a href="/" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-chart-simple"></i>
			</span>
			<span class="menu-title">گزارش ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item">
		<!--begin:Menu link-->
		<a href="/" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-layer-group"></i>
			</span>
			<span class="menu-title">منو ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-cube"></i>
			</span>
			<span class="menu-title">بلاک ها</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('block.list') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه ی بلاک ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link" href="{{ route('block.create') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن بلاک جدید</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
		</div>
		<!--end:Menu sub-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('settings.show')}}" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-gear"></i>
			</span>
			<span class="menu-title">تنظیمات</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->
</div>
<!--end::Menu-->