@extends('layouts.primary')

@section('title', 'اقساط')

@section("toolbar")
<a href="{{route('credit.create')}}" class="btn btn-primary">افزودن اقساط برای کاربر</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-between mb-5" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid lg:w-250px ps-15" placeholder="جست و جو" />
            </div>
            <button class="btn btn-success tw-w-max" name="export-csv">خروجی csv</button>
        </form>
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select form-select-solid tw-w-max" name="" id="">
                        <option>عملیات</option>
                        <option value="delete">حذف</option>
                    </select>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
            </div>

            <div id="filter_collapse" class="collapse">
                <div class="d-flex align-items-end flex-wrap w-100 gap-10">
                    <div>
                        <label class="form-label" for="">تاریخ سررسید</label>
                        <input type="text" name="date" placeholder="انتخاب تاریخ" class="form-control form-control-solid" id="filter_date">
                    </div>
                    <div>
                        <label class="form-label" for="">نوع پرداخت</label>
                        <select name="" id="" class="form-select form-select-solid">
                            <option value="1" selected>همه</option>
                            <option value="2">درگاه پرداخت</option>
                            <option value="3">حضوری</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="">پرداخت شده</label>
                        <select name="" id="" class="form-select form-select-solid">
                            <option value="1" selected>بله</option>
                            <option value="2">خیر</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
            </div>

            <table id="credits_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#credits_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">عنوان</th>
                        <th class="cursor-pointer px-0 text-start">تاریخ سر رسید</th>
                        <th class="cursor-pointer px-0 text-start">تاریخ پرداخت</th>
                        <th class="cursor-pointer px-0 text-start">شماره تلفن کاربر</th>
                        <th class="cursor-pointer px-0 text-start">نوع پرداخت</th>
                        <th class="cursor-pointer px-0 text-start">کد رهگیری</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('credit.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">قسط اول سفارش #1212</a>
                        </td>
                        <td>
                            <a href="{{route('credit.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">12/12/1403</a>
                        </td>
                        <td>
                            <a href="{{route('credit.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">12/12/1403</a>
                        </td>
                        <td>
                            <a href="{{route('credit.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">09374039436</a>
                        </td>
                        <td>
                            <a href="{{route('credit.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">درگاه پرداخت</a>
                        </td>
                        <td>
                            <a href="{{route('credit.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">24235123</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('credit.edit',['id' => 1])}}" class="btn btn-light btn-sm">
                                ویرایش
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

        <ul class="pagination">
            <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
            <li class="page-item active"><a href="#" class="page-link">1</a></li>
            <li class="page-item"><a href="#" class="page-link">2</a></li>
            <li class="page-item "><a href="#" class="page-link">3</a></li>
            <li class="page-item "><a href="#" class="page-link">4</a></li>
            <li class="page-item "><a href="#" class="page-link">5</a></li>
            <li class="page-item "><a href="#" class="page-link">6</a></li>
            <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
        </ul>
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;

    flatpickr = $("#filter_date").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
        mode: "range"
    })
</script>

@endsection