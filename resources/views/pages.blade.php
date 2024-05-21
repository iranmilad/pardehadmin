@extends('layouts.primary')

@section('title', 'برگه ها')

@section("toolbar")
<a href="{{route('page.create')}}" class="btn btn-primary">برگه جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <div class="tw-flex tw-items-center tw-justify-between tw-flex-wrap">
            <form action="" method="get">
                @csrf
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                    <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جوی نوشته ها" />
                </div>
            </form>
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center tw-invisible" data-kt-docs-table-toolbar="selected">
                <div class="fw-bold me-5 tw-hidden sm:tw-block">
                    <span class="me-2" data-kt-docs-table-select="selected_count"></span> انتخاب شده
                </div>

                <form action="" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger" name="remove-items" id="remove-items">
                        حذف
                    </button>
                </form>
            </div>
        </div>

        <!--end::Group actions-->
        <table id="pages_table" class="table gy-5 gs-7">
            <thead>
                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                    <th class="w-10px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#pages_table .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="cursor-pointer px-0 min-w-100px text-start">عنوان</th>
                    <th class="px-0 tw-max-w-20 text-start">نویسنده</th>
                    <th class="px-0 tw-max-w-20 text-start">تاریخ</th>
                    <th class=" text-end">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" data-id="1" />
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('page.edit',['id' => 1]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">صفحه ی اصلی</a>
                    </td>
                    <td>
                        <span class="text-muted">فرهاد باقری</span>
                    </td>
                    <td>
                        <span class="text-primary">1400/01/01</span>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                عملیات
                            </button>
                            <form method="post" action="{{ route('page.delete') }}" class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('page.edit',['id' => 1]) }}">ویرایش</a></li>
                                <li><button type="submit" name="id" value="1" class="dropdown-item text-danger" href="#">حذف</button></li>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
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
