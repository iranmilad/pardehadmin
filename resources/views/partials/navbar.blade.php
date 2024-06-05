<!--begin::Menu-->
<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true">
	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{ route('index') }}" class="menu-link {{ Route::is('index') ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-grid-2"></i>
			</span>
			<span class="menu-title">پیشخوان</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('post*') || Route::is('tags*') || Request::is('postCategories*') || Request::is('comments*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('post.list')  ? 'active' : '' }}"  href="{{ route('post.list') }}">
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
				<a class="menu-link {{ Route::is('post.create')  ? 'active' : '' }}" href="{{ route('post.create') }}">
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
				<a class="menu-link  {{Request::is('postCategories*') ? 'active' : ''}}" href="{{ route('postCategories.list') }}">
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
				<a class="menu-link {{ Route::is('tags*')  ? 'active' : '' }}" href="{{ route('tags.list') }}">
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
				<a class="menu-link {{ Route::is('comments*')  ? 'active' : '' }}" href="{{route('comments.list')}}">
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
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('pages*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('pages.list')  ? 'active' : '' }}" href="{{ route('pages.list') }}">
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
				<a class="menu-link {{ Route::is('pages.create')  ? 'active' : '' }}" href="{{route('pages.create')}}">
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
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('imagemarkers.show')}}" class="menu-link {{ Route::is('imagemarkers.show')   ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-image"></i>
			</span>
			<span class="menu-title">نشانه گذاری تصویر</span>
		</a>
		<!--end:Menu link-->
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
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('products*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('products.list')  ? 'active' : '' }}" href="{{route('products.list')}}">
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
				<a class="menu-link {{ Route::is('products.create')  ? 'active' : '' }}" href="{{route('products.create')}}">
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
				<a class="menu-link {{ Route::is('categories.list') || Route::is('categories.*')  ? 'active' : '' }}" href="{{route('categories.list')}}">
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
				<a class="menu-link {{ Route::is('products.tags.*') ? 'active' : '' }}" href="{{route('products.tags.list')}}">
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
				<a class="menu-link {{ Route::is('attributes.*')  ? 'active' : '' }}" href="{{route('attributes.list')}}">
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
				<a class="menu-link {{ Route::is('products.reviews*')  ? 'active' : '' }}" href="{{route('products.reviews.list')}}">
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
		<a href="{{route('orders.show')}}" class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-bags-shopping"></i>
			</span>
			<span class="menu-title">سفارش ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('discounts*') ? 'show' : ''}}">
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
				<a class="menu-link" href="{{ route('discounts.list.show') }}">
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
				<a class="menu-link" href="{{ route('discount.create.show') }}">
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
		<a href="{{ route('slides.show') }}" class="menu-link {{ Route::is('slides.show') ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-rectangle-history"></i>
			</span>
			<span class="menu-title">اسلاید ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->
	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('messages.show')}}" class="menu-link {{ Route::is('messages.show') || Route::is('message.show') ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-messages"></i>
			</span>
			<span class="menu-title">پیام ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('worktimes.show')}}" class="menu-link {{ Route::is('worktimes.show') ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-timer"></i>
			</span>
			<span class="menu-title">زمان کاری</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('users*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('users.list')  ? 'active' : '' }}" href="{{ route('users.list') }}">
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
				<a class="menu-link {{ Route::is('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">
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
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('checks*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('checks.list.show') || Route::is('check.show')  ? 'active' : '' }}" href="{{ route('checks.list.show') }}">
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
				<a class="menu-link {{ Route::is('check.create.show')  ? 'active' : '' }}" href="{{ route('check.create.show') }}">
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
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('installments*') ? 'show' : ''}}">
		<!--begin:Menu link-->
		<span class="menu-link">
			<span class="menu-icon">
				<i class="fa-duotone fa-receipt"></i>
			</span>
			<span class="menu-title">اقساط</span>
			<span class="menu-arrow"></span>
		</span>
		<!--end:Menu link-->
		<!--begin:Menu sub-->
		<div class="menu-sub menu-sub-accordion">
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link {{ Route::is('credit.show') || Route::is('credit.*')  ? 'active' : '' }}" href="{{ route('credit.show') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">همه ی اقساط</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link {{ Route::is('installments.create')  ? 'active' : '' }}" href="{{ route('installments.create') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">افزودن اقساط برای کاربر</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->

			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link {{ Route::is('installments.plans.list.show') || Route::is('installments.plan.show')   ? 'active' : '' }}" href="{{ route('installments.plans.list.show') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">پلن ها</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->

			<!--begin:Menu item-->
			<div class="menu-item">
				<!--begin:Menu link-->
				<a class="menu-link {{ Route::is('installments.report.show')   ? 'active' : '' }}" href="{{ route('installments.report.show') }}">
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">گزارش اقساط</span>
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
		<a href="{{route('reports')}}" class="menu-link {{ Route::is('reports')   ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-chart-simple"></i>
			</span>
			<span class="menu-title">گزارش ها</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('checkouts.show')}}" class="menu-link {{ Route::is('checkouts.show')   ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-credit-card"></i>
			</span>
			<span class="menu-title">درگاه پرداخت</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->

	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('sms-settings.show')}}" class="menu-link {{ Route::is('sms-settings.show')   ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-comment-sms"></i>
			</span>
			<span class="menu-title">پیامک</span>
		</a>
		<!--end:Menu link-->
	</div>
	<!--end:Menu item-->


	<!--begin:Menu item-->
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('menus.show')}}" class="menu-link {{ Route::is('menus.show')  ? 'active' : '' }}">
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
				<a class="menu-link" href="{{ route('block.create.show') }}">
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
		<a href="{{route('settings.show')}}" class="menu-link {{ Route::is('settings.show') ? 'active' : '' }}">
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
