@extends('layouts.primary')

@section('title', 'مدیریت انبار')


@section('content')
<!-- START:TABLE -->
<div class="card mb-10">
    <div class="card-header">
        <div class="w-100 d-flex align-items-center justify-content-between">
            <h4>ویرایش دسته جمعی</h4>
            <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#edit-collapse">
                <i class="fal fa-chevron-down"></i>
            </button>
        </div>
    </div>
    <div class="collapse" id="edit-collapse">
        <div class="card-body">
            <form method="post" action class="row mt-5 g-4">
                @csrf
                <div class="col-md-6">
                    <div>
                        <label class="form-label" for="">محصولات</label>
                        <x-advanced-search type="product" label="" name="product" solid />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="new_price" class="form-label fw-bold">تعداد موجودی:</label>
                    <div>
                        <input class="form-control form-control-solid" type="number" placeholder="تعداد موجودی را وارد کنید" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="new_price" class="form-label fw-bold">وضعیت:</label>
                    <div>
                        <select class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="" id="" data-hide-search="true">
                            <option value="1">موجود</option>
                            <option value="2">موجودی کم</option>
                            <option value="3">ناموجود</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <button name="submit" type="submit" class="btn btn-success">بروزرسانی</button>
                    <button name="cancel" type="submit" class="btn btn-secondary">لغو</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
                <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                    <select class="form-select form-select-solid tw-w-max" name="" id="">
                        <option>عملیات</option>
                        <option value="delete">ویرایش دسته ای</option>
                    </select>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
                </div>
            </div>

            <div id="filter_collapse" class="collapse">
                <div class="d-flex align-items-end flex-wrap w-100 gap-10">
                    <div>
                        <label class="form-label" for="">وضعیت</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="" id="">
                            <option value="1">موجود</option>
                            <option value="2">موجودی کم</option>
                            <option value="3">ناموجود</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="">حداقل موجودی</label>
                        <input class="form-control form-control-solid" placeholder="وارد کنید" name="min-exists" />
                    </div>
                    <div>
                        <label class="form-label" for="">حداکثر موجودی</label>
                        <input class="form-control form-control-solid" placeholder="وارد کنید" name="min-exists" />
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
                </div>
            </div>
            <table id="global_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">کد محصول</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">موجودی</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">وضعیت</th>
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
                            <a href="{{route('store-management.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">پرده مخمل</a>
                        </td>
                        <td>
                            <a href="{{route('store-management.show',['id' => 1])}}">#12345</a>
                        </td>
                        <td>
                            <a href="{{route('store-management.show',['id' => 1])}}">20 عدد</a>
                        </td>
                        <td>
                            <a class="badge badge-success" href="{{route('store-management.show',['id' => 1])}}">موجود</a>
                            <a class="badge badge-warning" href="{{route('store-management.show',['id' => 1])}}">موجودی کم</a>
                            <a class="badge badge-danger" href="{{route('store-management.show',['id' => 1])}}">ناموجود</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('store-management.show',['id' => 1])}}" class="btn btn-light btn-sm">
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