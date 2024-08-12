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
    @if(userHasPermission('manage_posts') || userHasPermission('manage_tags') || userHasPermission('manage_post_categories') || userHasPermission('manage_comments'))
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
                @if(userHasPermission('manage_posts'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('post.index') ? 'active' : '' }}" href="{{ route('post.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه نوشته</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_posts'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('post.create') ? 'active' : '' }}" href="{{ route('post.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن نوشته</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_post_categories'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{Request::is('postCategories*') ? 'active' : ''}}" href="{{ route('postCategories.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">دسته ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_tags'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('tags*') ? 'active' : '' }}" href="{{ route('tags.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">برچسب ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_comments'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('comments*') ? 'active' : '' }}" href="{{ route('comments.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">دیدگاه ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->


    <!--begin:Menu item-->
    @if(userHasPermission('manage_pages'))
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
                @if(userHasPermission('manage_pages'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('pages.index') ? 'active' : '' }}" href="{{ route('pages.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه برگه ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_pages'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('pages.create') ? 'active' : '' }}" href="{{ route('pages.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن برگه جدید</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_image_markers'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('image-markers.index') }}" class="menu-link {{ Route::is('image-markers.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-image"></i>
                </span>
                <span class="menu-title">نشانه گذاری تصویر</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_files'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('files-manager') }}" class="menu-link {{ Route::is('files-manager') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-folder-open"></i>
                </span>
                <span class="menu-title">مدیریت فایل ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_products'))
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
                @if(userHasPermission('manage_products'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی محصولات</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_products'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن محصول جدید</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_product_categories'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('categories.index') || Route::is('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">دسته بندی ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_product_tags'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('products.tags.*') ? 'active' : '' }}" href="{{ route('products.tags.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">برچسب ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_attributes'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('attributes.*') ? 'active' : '' }}" href="{{ route('attributes.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">ویژگی ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_reviews'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('products.reviews*') ? 'active' : '' }}" href="{{ route('products.reviews.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">دیدگاه ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_product_settings'))
                    <div class="menu-item d-none">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('products.settings') ? 'active' : '' }}" href="{{ route('products.settings') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">پیکربندی</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_orders'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('orders.index') }}" class="menu-link {{ Request::is('orders*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-bags-shopping"></i>
                </span>
                <span class="menu-title">سفارش ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_service_orders'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('service-orders.show') }}" class="menu-link {{ Request::is('service-orders*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-bags-shopping"></i>
                </span>
                <span class="menu-title">سفارشات خدمت</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_carts'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('carts.index') }}" class="menu-link {{ Route::is('carts.index') || Route::is('carts.edit') || Route::is('carts.create') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-shopping-cart"></i>
                </span>
                <span class="menu-title">سبد خرید کاربران</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_transports'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('transports.index') }}" class="menu-link {{ Route::is('transports.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-truck-fast"></i>
                </span>
                <span class="menu-title">حمل و نقل</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_discounts'))
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
                @if(userHasPermission('manage_discounts'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('discounts.index') || Route::is('discount.edit') ? 'active' : '' }}" href="{{ route('discounts.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی تخفیف ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_discounts'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('discounts.create') ? 'active' : '' }}" href="{{ route('discounts.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن تخفیف جدید</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!-- end:Menu item -->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_sliders'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('sliders.index') }}" class="menu-link {{ Route::is('sliders.index') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-rectangle-history"></i>
                </span>
                <span class="menu-title">اسلاید ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_sessions'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('sessions.index') }}" class="menu-link {{ Route::is('sessions.show') || Route::is('message.show') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-messages"></i>
                </span>
                <span class="menu-title">پیام ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_worktimes'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('worktimes.index') }}" class="menu-link {{ Route::is('worktimes.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-timer"></i>
                </span>
                <span class="menu-title">زمان کاری</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_tasks'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('tasks.show') }}" class="menu-link {{ Request::is('tasks*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-solid fa-list-check"></i>
                </span>
                <span class="menu-title">کار ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_users'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('users*') ? 'show' : '' }}">
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
                @if(userHasPermission('manage_users'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی کاربران</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_users'))
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
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_roles'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('users.roles.index') ? 'active' : '' }}" href="{{ route('users.roles.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">نقش ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!-- end:Menu item -->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_scores'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('scores*') ? 'show' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-duotone fa-solid fa-star-half"></i>
                </span>
                <span class="menu-title">امتیاز دهی</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                @if(userHasPermission('manage_score_groups'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('score-groups.index') ? 'active' : '' }}" href="{{ route('score-groups.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">شرایط گروه ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('configure_score_groups'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('score-groups.setting') ? 'active' : '' }}" href="{{ route('score-groups.setting') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">پیکربندی</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!-- end:Menu item -->


    <!--begin:Menu item-->
    @if(userHasPermission('manage_customer_groups'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('groups*') ? 'show' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-duotone fa-user-group-crown"></i>
                </span>
                <span class="menu-title">گروه مشتریان</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                @if(userHasPermission('manage_customer_groups'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('groups.index') ? 'active' : '' }}" href="{{ route('groups.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی گروه ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_customer_groups'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('groups.create') ? 'active' : '' }}" href="{{ route('groups.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن گروه جدید</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_checks'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('checks*') ? 'show' : '' }}">
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
                @if(userHasPermission('manage_checks'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('checks.index') || Route::is('checks.show') ? 'active' : '' }}" href="{{ route('checks.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی چک ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_checks'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('checks.create') ? 'active' : '' }}" href="{{ route('checks.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن چک برای کاربر</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_installments'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('installments*') ? 'show' : '' }}">
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
                @if(userHasPermission('manage_installments'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('credits.show') || Route::is('credits.*') ? 'active' : '' }}" href="{{ route('credits.show') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی اقساط</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_installments'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('installments.create') ? 'active' : '' }}" href="{{ route('installments.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن اقساط برای کاربر</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_installment_plans'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('installments.plans.index.show') || Route::is('installments.plan.show') ? 'active' : '' }}" href="{{ route('installments.plans.index.show') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">پلن ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_installment_reports'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('installments.report.show') ? 'active' : '' }}" href="{{ route('installments.report.show') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">گزارش اقساط</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_reports'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('reports*') ? 'show' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-duotone fa-money-check-dollar"></i>
                </span>
                <span class="menu-title">گزارش ها</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                @if(userHasPermission('manage_reports'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('settlement_documents.index') ? 'active' : '' }}" href="{{ route('settlement_documents.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه گزارش ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_reports'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('settlement_documents.create') ? 'active' : '' }}" href="{{ route('settlement_documents.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن گزارش</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_gateways'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{route('gateways.index')}}" class="menu-link {{ Route::is('gateways.index') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-credit-card"></i>
                </span>
                <span class="menu-title">درگاه پرداخت</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_sms'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{route('sms.index')}}" class="menu-link {{ Route::is('sms.*') || Route::is('sms.index') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-comment-sms"></i>
                </span>
                <span class="menu-title">پیامک</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_code_pieces'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{route('code-piceces.index')}}" class="menu-link {{ Request::is('code-piceces.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-terminal"></i>
                </span>
                <span class="menu-title">قطعه کد ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_workflows'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('workflows*') ? 'show' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-duotone fa-solid fa-network-wired"></i>
                </span>
                <span class="menu-title">فرآیند ها</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                @if(userHasPermission('manage_workflows'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('workflows.show') ? 'active' : '' }}" href="{{route('workflows.show')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه فرآیند ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_workflows'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('workflow.create.show') ? 'active' : '' }}" href="{{route('workflow.create.show')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">ایجاد فرآیند</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_workflow'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('workflow-logs.show') || Route::is('workflow-log.show') ? 'active' : '' }}" href="{{route('workflow-logs.show')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">گزارش فرآیند ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_third_party_services'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('services*') ? 'show' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-duotone fa-rocket-launch"></i>
                </span>
                <span class="menu-title">سرویس های شخص ثالث</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                @if(userHasPermission('manage_holo_service'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('settings.holo.edit', 'holo') ? 'active' : '' }}" href="{{route('settings.holo.edit', 'holo')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">سرویس هلو</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_sms_service'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('services.sms.edit', 'sms') ? 'active' : '' }}" href="{{route('services.sms.edit', 'sms')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">سرویس پیامک</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_menus'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{route('menus.index')}}" class="menu-link {{ Route::is('menus.index') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-layer-group"></i>
                </span>
                <span class="menu-title">منو ها</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_customize'))
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ route('customize.show') }}" class="menu-link {{ Route::is('customize.show') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-duotone fa-swatchbook"></i>
                </span>
                <span class="menu-title">سفارشی سازی</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_blocks'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('block*') ? 'show' : '' }}">
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
                @if(userHasPermission('manage_blocks'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('blocks.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">همه ی بلاک ها</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @if(userHasPermission('manage_blocks'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('blocks.create') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">افزودن بلاک جدید</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @if(userHasPermission('manage_settings'))
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('settings*') ? 'show' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fa-duotone fa-memo"></i>
                </span>
                <span class="menu-title">تنظیمات</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                @if(userHasPermission('manage_settings'))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('settings.show') ? 'active' : '' }}" href="{{ route('settings.edit', 'general') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">عمومی</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endif
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endif
    <!--end:Menu item-->


</div>
<!--end::Menu-->
