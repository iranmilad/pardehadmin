@extends('layouts.primary')

@section('title', 'کار ها')


@section('content')

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="not-started-tab" data-bs-toggle="pill" data-bs-target="#not-started" type="button" role="tab" aria-controls="not-started" aria-selected="true">شروع نشده</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="doing-tab" data-bs-toggle="pill" data-bs-target="#doing" type="button" role="tab" aria-controls="doing" aria-selected="false">درحال انجام</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="finished-tab" data-bs-toggle="pill" data-bs-target="#finished" type="button" role="tab" aria-controls="finished" aria-selected="false">پایان یافته</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="not-started" role="tabpanel" aria-labelledby="not-started-tab" tabindex="0">
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

                    <table id="global1_table" class="table gy-5 gs-7">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="w-10px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global1_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="cursor-pointer px-0 text-start">عنوان</th>
                                <th class="cursor-pointer px-0 text-start">سفارش</th>
                                <th class="cursor-pointer px-0 text-start">وضعیت</th>
                                <th class="cursor-pointer px-0 text-start">انجام دهنده</th>
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
                                    <a href="{{route('task.edit.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">خدمت خیاطی</a>
                                </td>
                                <td>
                                    <a href="{{route('order.show',['id' => 1])}}" class="text-primary fs-6 fw-bolder mb-1">#123</a>
                                </td>
                                <td>
                                    <a class="badge badge-info" href="{{route('task.edit.show',['id' => 1])}}">در حال انجام</a>
                                    <a class="badge badge-success" href="{{route('task.edit.show',['id' => 1])}}">انجام شده</a>
                                    <a class="badge badge-secondary" href="{{route('task.edit.show',['id' => 1])}}">شروع نشده</a>
                                </td>
                                <td>
                                    <a href="{{route('user.profile',['id' => 1])}}">فرهاد باقری</a>
                                </td>
                                <td class="text-end">
                                    <a href="{{route('task.edit.show',['id' => 1])}}" class="btn btn-light btn-sm">
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
    </div>
    <div class="tab-pane fade" id="doing" role="tabpanel" aria-labelledby="doing-tab" tabindex="0">
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

                    <table id="global1_table" class="table gy-5 gs-7">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="w-10px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global1_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="cursor-pointer px-0 text-start">عنوان</th>
                                <th class="cursor-pointer px-0 text-start">سفارش</th>
                                <th class="cursor-pointer px-0 text-start">وضعیت</th>
                                <th class="cursor-pointer px-0 text-start">انجام دهنده</th>
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
                                    <a href="{{route('task.edit.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">طراحی طرح</a>
                                </td>
                                <td>
                                    <a href="{{route('order.show',['id' => 1])}}" class="text-primary fs-6 fw-bolder mb-1">#789</a>
                                </td>
                                <td>
                                    <a class="badge badge-info" href="{{route('task.edit.show',['id' => 1])}}">در حال انجام</a>
                                    <a class="badge badge-success" href="{{route('task.edit.show',['id' => 1])}}">انجام شده</a>
                                    <a class="badge badge-secondary" href="{{route('task.edit.show',['id' => 1])}}">شروع نشده</a>
                                </td>
                                <td>
                                    <a href="{{route('user.profile',['id' => 1])}}">کوروش منصوری</a>
                                </td>
                                <td class="text-end">
                                    <a href="{{route('task.edit.show',['id' => 1])}}" class="btn btn-light btn-sm">
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
    </div>
    <div class="tab-pane fade" id="finished" role="tabpanel" aria-labelledby="finished-tab" tabindex="0">
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

                    <table id="global2_table" class="table gy-5 gs-7">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="w-10px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global2_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="cursor-pointer px-0 text-start">عنوان</th>
                                <th class="cursor-pointer px-0 text-start">سفارش</th>
                                <th class="cursor-pointer px-0 text-start">وضعیت</th>
                                <th class="cursor-pointer px-0 text-start">انجام دهنده</th>
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
                                    <a href="{{route('task.edit.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">نصب</a>
                                </td>
                                <td>
                                    <a href="{{route('order.show',['id' => 1])}}" class="text-primary fs-6 fw-bolder mb-1">#789</a>
                                </td>
                                <td>
                                    <a class="badge badge-info" href="{{route('task.edit.show',['id' => 1])}}">در حال انجام</a>
                                    <a class="badge badge-success" href="{{route('task.edit.show',['id' => 1])}}">انجام شده</a>
                                    <a class="badge badge-secondary" href="{{route('task.edit.show',['id' => 1])}}">شروع نشده</a>
                                </td>
                                <td>
                                    <a href="{{route('user.profile',['id' => 1])}}">کوروش منصوری</a>
                                </td>
                                <td class="text-end">
                                    <a href="{{route('task.edit.show',['id' => 1])}}" class="btn btn-light btn-sm">
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
    </div>
</div>

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endsection
