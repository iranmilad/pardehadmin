<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ویرایش چک')

@section('content')

<!-- PARENT -->
<div class="card mb-8">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات کاربر</h3>
            </div>
        </div>
        <div class="card-body">
            @if(Route::is('check.create.show'))
            <div class="mb-10">
                <x-advanced-search type="user" label="انتخاب کاربر" name="selected_user" />
            </div>
            @else
            <div class="symbol symbol-40px me-3">
                <a href="{{route('user.profile',['id' => 1])}}" class="d-flex align-items-center flex-row">
                    <div class="symbol symbol-40px me-3">
                        <img src="/images/avatar.png" class="" alt="" />
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">فرهاد باقری</span>
                        <span class="text-primary">مشاهده کاربر</span>
                    </div>
                </a>
            </div>
            <div class="row mt-10">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <label class="form-label">تکمیل شده:</label>
                    <span class="badge badge-primary">خیر</span>
                    <span class="badge badge-success">بله</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <label class="form-label">تعداد پرداختی:</label>
                    <span class="badge badge-primary">5 <span class="mx-2">از</span>12</span>
                    <span class="badge badge-success">12 <span class="mx-2">از</span>12</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <label class="form-label">تاریخ پرداخت بعدی:</label>
                    <span class="text-primary">12/12/1403</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <label class="form-label">مبلغ کل:</label>
                    <span class="text-primary">12,000,000</span>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
<!-- PARENT -->
<!-- CHILDREN COLOR -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات برگه چک ها</h3>
            </div>
        </div>
        <div class="card-body">
            <!-- CHILDREN -->
            <div class="row">
                <div class="check_repeater">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <div data-repeater-list="check_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">شناسه یکتا:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">مبلغ:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="مبلغ را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required" for="">تاریخ:</label>
                                        <input class="form-control mb-2 mb-md-0 form-date" type="text" name="option[date]" placeholder="تاریخ را انتخاب کنید">
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">وضعیت:</label>
                                        <select name="option[status]" class="form-select  mb-2 mb-md-0">
                                            <option value="1">بدون وضعیت</option>
                                            <option value="2">پاس شده</option>
                                            <option value="3">پاس نشده</option>
                                            <option value="4">برگشت خورده</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            حذف
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                            افزودن
                            <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CHILDREN COLOR -->

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;
    document.addEventListener("DOMContentLoaded", function() {

        $(".check_repeater").repeater({
            initEmpty: false,
            ready: function() {
                $('.form-date').flatpickr({
                    disableMobile: "true",
                    altInput: true,
                    altFormat: "Y-m-d",
                    dateFormat: "Y-m-d",
                    locale: "fa",
                });
            },
            show: function() {
                $(this).slideDown();
                $(this).parent().find('.form-date').flatpickr({
                    disableMobile: "true",
                    altInput: true,
                    altFormat: "Y-m-d",
                    dateFormat: "Y-m-d",
                    locale: "fa",
                });
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    })
</script>
@endsection