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
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('posts*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('posts.show')  ? 'active' : '' }}" href="{{ route('posts.show') }}">
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
				<a class="menu-link {{ Route::is('post.show')  ? 'active' : '' }}" href="{{ route('post.show') }}">
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
				<a class="menu-link {{ Route::is('post-categories.show') || Route::is('post-category.show') || Route::is('post-category.create.show')  ? 'active' : '' }}" href="{{ route('post-categories.show') }}">
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
				<a class="menu-link {{ Route::is('post.tags.show') || Route::is('post.tag.show') || Route::is('post.tag.create.show')  ? 'active' : '' }}" href="{{ route('post.tags.show') }}">
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
				<a class="menu-link {{ Route::is('post.comments.show') || Route::is('post.comment.show')  ? 'active' : '' }}" href="{{route('post.comments.show')}}">
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
	<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::is('page*') ? 'show' : ''}}">
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
				<a class="menu-link {{ Route::is('page.list.show') || Route::is('page.edit')  ? 'active' : '' }}" href="{{ route('page.list.show') }}">
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
				<a class="menu-link {{ Route::is('page.create')  ? 'active' : '' }}" href="{{route('page.create')}}">
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
				<a class="menu-link {{ Route::is('products.list.show')  ? 'active' : '' }}" href="{{route('products.list.show')}}">
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
				<a class="menu-link {{ Route::is('product.create.show')  ? 'active' : '' }}" href="{{route('product.create.show')}}">
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
				<a class="menu-link {{ Route::is('product.categories.show') || Route::is('product.category.show')  ? 'active' : '' }}" href="{{route('product.categories.show')}}">
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
				<a class="menu-link {{ Route::is('product.tags.show') || Route::is('product.tag.show') || Route::is('product.tag.create.show')  ? 'active' : '' }}" href="{{route('product.tags.show')}}">
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
				<a class="menu-link {{ Route::is('attributes.list.show') || Route::is('attribute.create.show') || Route::is('attribute.show') ? 'active' : '' }}" href="{{route('attributes.list.show')}}">
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
				<a class="menu-link {{ Route::is('product.comments.show') || Route::is('product.comment.show')  ? 'active' : '' }}" href="{{route('product.comments.show')}}">
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
				<a class="menu-link {{ Route::is('user.create') ? 'active' : '' }}" href="{{ route('user.create') }}">
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
				<a class="menu-link {{ Route::is('installments.list.show') || Route::is('installment.show')  ? 'active' : '' }}" href="{{ route('installments.list.show') }}">
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
				<a class="menu-link {{ Route::is('installment.create.show')  ? 'active' : '' }}" href="{{ route('installment.create.show') }}">
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
		<a href="{{route('snippets.list.show')}}" class="menu-link {{Request::is('snippets*') ? 'active' : ''}}">
			<span class="menu-icon">
				<i class="fa-duotone fa-terminal"></i>
			</span>
			<span class="menu-title">قطعه کد ها</span>
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
	<div class="menu-item">
		<!--begin:Menu link-->
		<a href="{{route('customize.show')}}" class="menu-link {{ Route::is('customize.show')  ? 'active' : '' }}">
			<span class="menu-icon">
				<i class="fa-duotone fa-swatchbook"></i>
			</span>
			<span class="menu-title">سفارشی سازی</span>
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