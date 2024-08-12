<!--begin::Navbar-->
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ $user->avatar ?? '/images/avatar.png' }}" alt="image">
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::user-->
                    <div class="d-flex flex-column">
                        <!--begin::نام-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->first_name .' '. $user->last_name }} </a>
                            <a href="#">
                                <i class="ki-duotone ki-verify fs-1 tw-text-blue-500">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                        </div>
                        <!--end::نام-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>{{ $user->role->title ?? 'ثبت نشده' }}</a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-geolocation fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>{{ $user->province ?? 'ثبت نشده' }}</a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="fa-duotone fa-phone-volume me-2 fs-7"></i>
                                {{ $user->mobile ?? 'ثبت نشده' }}</a>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::user-->
                    <!--begin::Actions-->
                    <div class="d-flex my-4">

                        <!--begin::Menu-->
                        <div class="me-0">
                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-solid ki-dots-horizontal fs-2x me-1"></i>
                            </button>
                            <!--begin::Menu 3-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                        <!-- لینک حذف کاربر -->
                                        <a href="{{ route('users.delete', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">حذف کاربر</a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.delete', $user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>


                                </div>
                            </div>
                            <!--end::Menu 3-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Title-->
                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::شماره کارت-->
                                <div class="d-flex align-items-center">
                                    <i class="fa-duotone fa-badge-dollar fs-7 text-warning me-2"></i>
                                    <div class="fs-3 fw-bold counted">{{ $user->credit_limit ?? 0}}</div>
                                </div>
                                <!--end::شماره کارت-->
                                <!--begin::Tags-->
                                <div class="fw-semibold fs-6 text-gray-400">اعتبار</div>
                                <!--end::Tags-->
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::شماره کارت-->
                                <div class="d-flex align-items-center">
                                    <i class="fa-duotone fa-money-check-dollar fs-7 text-success me-2"></i>
                                    <div class="fs-3 fw-bold counted">{{ $user->credits->where('payment_status','paid')->count(). '/' .$user->credits->count() }}</div>
                                </div>
                                <!--end::شماره کارت-->
                                <!--begin::Tags-->
                                <div class="fw-semibold fs-6 text-gray-400"> اقساط پرداخت شده</div>
                                <!--end::Tags-->
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::شماره کارت-->
                                <div class="d-flex align-items-center">
                                    <i class="fa-duotone fa-money-bill-1-wave fs-7 text-info me-2"></i>
                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ $user->totalOrderAmount ?? 0}}</div>
                                </div>
                                <!--end::شماره کارت-->
                                <!--begin::Tags-->
                                <div class="fw-semibold fs-6 text-gray-400">مبلغ خرید ها</div>
                                <!--end::Tags-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::پردازش-->
                    {{-- <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                            <span class="fw-semibold fs-6 text-gray-400">تکمیل پروفایل</span>
                            <span class="fw-bold fs-6">50%</span>
                        </div>
                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                            <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div> --}}
                    <!--end::پردازش-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <!--begin::Navs-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::currentRouteName() === 'user.profile' ? 'active' : '' }}" href="{{ route('users.profile',['id' => $user->id]) }}">بررسی اجمالی</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{ route('users.edit',['id' => $user->id]) }}">ویرایش</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{ route('orders.index') }}?s={{$user->fullName}}">سفارش ها</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{ route('checks.index') }}?s={{$user->fullName}}">چک ها</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{ route('credits.show') }}?s={{$user->fullName}}">سررسید اقساط</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{ route('products.reviews.index') }}?s={{$user->fullName}}">دیدگاه ها</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="{{ route('users.sessions.index',['id' => $user->id]) }}">نشست ها</a>
            </li>
            <!--end::Nav item-->
        </ul>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->
