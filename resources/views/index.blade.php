@extends('layouts.primary')

@section('title', 'پیشخوان')

@section('content')
<div class="row g-5 g-xl-10 ">
    <!--begin::Col-->
    <div class="col-xl-6 tw-h-auto">
        <div class="card tw-h-full">
            <div class="card-header">
                <h3 class="card-title">
                    اخبار و اطلاعیه ها
                </h3>
            </div>
            <div class="card-body ps-0 tw-overflow-auto" style="max-height: 450px;">
                <ul class="tw-list-none mb-5">
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">محصول شماره #1234 بروزرسانی شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">یک پیام جدید دارید !</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">3 سفارش جدید اضافه جدید</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">4 کاربر جدید ثبت نام کردند</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">4 درخواست تایید کار دارید</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">مشکلی در انجام فعالیت ها رخ داده</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                    <li class="tw-bg-slate-50 tw-rounded-md  py-4 tw-pr-4 mt-4"><span class="badge badge-success me-3">جدید</span><a href="#">گروه جدید مشتریان اضافه شد</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush dashboard-card-chart overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-center flex-row">
                    <span class="card-label fw-bold text-dark tw-whitespace-nowrap">آمار بازدید</span>
                    <select class="form-select form-control-sm form-select-solid" name="" id="dashboard-view-stat">
                        <option value="">امروز</option>
                        <option value="">3 روز پیش</option>
                        <option value="">1 هفته</option>
                        <option value="">1 ماه</option>
                        <option value="">1 سال</option>
                    </select>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button class="btn btn-color-gray-400 btn-active-color-primary p-2 px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <span class="fs-7">مشاهده آمار</span>
                    </button>
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::کارت body-->
            <div class="card-body px-0">
                <!--begin::Chart-->
                <div id="view_chart" class="min-h-auto w-100 ps-4 pe-6" style="height: auto"></div>
                <!--end::Chart-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::جداول widget 16-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">آخرین سفارش ها</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button class="btn btn-color-gray-400 btn-active-color-primary p-2 px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <span class="fs-7">مشاهده سفارشات</span>
                    </button>
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-6">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-150px text-start">محصول</th>
                                <th class="p-0 pb-3 min-w-100px text-end pe-13">قیمت</th>
                                <th class="p-0 pb-3 w-125px text-end pe-7">تاریخ</th>
                                <th class="p-0 pb-3 w-50px text-end">نمایش</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="/images/product/1.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="../../demo1/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">پرده هازان خردلی</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1 عدد</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-13">
                                    <span class="text-gray-600 fw-bold fs-6">12,000,000</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="text-gray-600 fw-bold fs-6">1403/01/01</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-eye fs-5 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="/images/product/1.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="../../demo1/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">پرده هازان خردلی</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1 عدد</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-13">
                                    <span class="text-gray-600 fw-bold fs-6">12,000,000</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="text-gray-600 fw-bold fs-6">1403/01/01</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-eye fs-5 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="/images/product/1.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="../../demo1/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">پرده هازان خردلی</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1 عدد</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-13">
                                    <span class="text-gray-600 fw-bold fs-6">12,000,000</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="text-gray-600 fw-bold fs-6">1403/01/01</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-eye fs-5 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="/images/product/1.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="../../demo1/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">پرده هازان خردلی</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1 عدد</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-13">
                                    <span class="text-gray-600 fw-bold fs-6">12,000,000</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="text-gray-600 fw-bold fs-6">1403/01/01</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-eye fs-5 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="/images/product/1.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="../../demo1/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">پرده هازان خردلی</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1 عدد</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-13">
                                    <span class="text-gray-600 fw-bold fs-6">12,000,000</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="text-gray-600 fw-bold fs-6">1403/01/01</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-eye fs-5 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end: کارت Body-->
        </div>
        <!--end::جداول widget 16-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush dashboard-card-chart overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-center flex-row">
                    <span class="card-label fw-bold text-dark tw-whitespace-nowrap">آمار فروش</span>
                    <select class="form-select form-control-sm form-select-solid" name="" id="dashboard-sell-stat">
                        <option value="">امروز</option>
                        <option value="">3 روز پیش</option>
                        <option value="">1 هفته</option>
                        <option value="">1 ماه</option>
                        <option value="">1 سال</option>
                    </select>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button class="btn btn-color-gray-400 btn-active-color-primary p-2 px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <span class="fs-7">مشاهده آمار</span>
                    </button>
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::کارت body-->
            <div class="card-body px-0">
                <!--begin::Chart-->
                <div id="sell_chart" class="min-h-auto w-100 ps-4 pe-6" style="height: auto"></div>
                <!--end::Chart-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::جداول widget 16-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">آخرین دیدگاه ها</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button class="btn btn-color-gray-400 btn-active-color-primary p-2 px-0" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <span class="fs-7">مشاهده دیدگاه ها</span>
                    </button>
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-6">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-150px text-start">پروفایل</th>
                                <th class="p-0 pb-3 min-w-100px text-start">دیدگاه</th>
                                <th class="p-0 pb-3 w-125px text-end pe-7">وضعیت</th>
                                <th class="p-0 pb-3 w-50px text-end">عملیات</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <img src="/images/avatar.png" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">فرهاد باقری</span>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1403/01/01</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-end ">
                                    <span class="text-gray-600 text-start fw-bold fs-6 tw-line-clamp-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="badge badge-success rounded-pill fs-6">تایید شده</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <img src="/images/avatar.png" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">فرهاد باقری</span>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1403/01/01</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-end ">
                                    <span class="text-gray-600 text-start fw-bold fs-6 tw-line-clamp-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="badge badge-success rounded-pill badge-danger fs-6">تایید نشده</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <img src="/images/avatar.png" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">فرهاد باقری</span>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1403/01/01</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-end ">
                                    <span class="text-gray-600 fw-bold text-start fs-6 tw-line-clamp-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="badge badge-info rounded-pill fs-6">اسپم</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <img src="/images/avatar.png" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">فرهاد باقری</span>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1403/01/01</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-end ">
                                    <span class="text-gray-600 fw-bold text-start fs-6 tw-line-clamp-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="badge badge-success rounded-pill fs-6">تایید شده</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <img src="/images/avatar.png" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">فرهاد باقری</span>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">1403/01/01</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-end ">
                                    <span class="text-gray-600 fw-bold text-start fs-6 tw-line-clamp-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</span>
                                </td>
                                <td class="text-end pe-7">
                                    <span class="badge badge-info rounded-pill fs-6">اسپم</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa-duotone fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end: کارت Body-->
        </div>
        <!--end::جداول widget 16-->
    </div>
    <!--end::Col-->
</div>
@endsection