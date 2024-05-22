@extends('layouts.primary')

@section('title', 'تخفیف ها')

@section("toolbar")
<a href="{{route('discount.create.show')}}" class="btn btn-primary">تخفیف جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="" id="">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="discounts_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#discounts_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">کد</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نوع تخفیف</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">مبلغ تخفیف</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">شناسه های محصول</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">مصرف / محدودیت</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">تاریخ انقضا</th>
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
                            <a href="{{route('discount.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">first_buy</a>
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}">تخفیف ثابت سبد خرید</a>
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}">100,000</a>
                        </td>
                        <td>
                            <a class="badge badge-success" href="{{route('discount.show',['id' => 1])}}">همه</a>
                        </td>
                        <td>
                            ∞ / 12
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}">بدون انقضا</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('discount.show',['id' => 1])}}" class="btn btn-sm btn-light">
                                ویرایش
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">50off</a>
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}">تخفیف ثابت سبد خرید</a>
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}">50%</a>
                        </td>
                        <td>
                            <a class="badge badge-primary" href="{{route('discount.show',['id' => 1])}}">12</a>
                            <a class="badge badge-primary" href="{{route('discount.show',['id' => 1])}}">14</a>
                        </td>
                        <td>
                            1/1
                        </td>
                        <td>
                            <a href="{{route('discount.show',['id' => 1])}}">12/12/1403</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('discount.show',['id' => 1])}}" class="btn btn-sm btn-light">
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
@endsection