@extends('layouts.primary')

@section('title', 'نوشته ها')

@section("toolbar")
<a href="{{route('post')}}?action=add" class="btn btn-primary">نوشته جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form action="" method="get">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جوی نوشته ها" />
            </div>
        </form>
        <!--begin::Group actions-->
    <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
        <div class="fw-bold me-5">
            <span class="me-2" data-kt-docs-table-select="selected_count"></span> انتخاب شده
        </div>

        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Coming Soon">
            حذف
        </button>
    </div>
    <!--end::Group actions-->
        <table id="posts_table" class="table gy-5 gs-7">
            <thead>
                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                    <th class="w-10px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#posts_table .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
                    <th class="cursor-pointer px-0 min-w-175px text-start">نویسنده</th>
                    <th class="cursor-pointer px-0 min-w-175px text-start">دسته ها</th>
                    <th class="px-0 min-w-100px text-start">برچسب ها</th>
                    <th class="px-0 tw-max-w-20 text-start">نظرات</th>
                    <th class="px-0 min-w-100px text-end">تاریخ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    </td>
                    <td>
                        <a href="{{route('post')}}?action=edit&id=1" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">نوشته اول</a>
                    </td>
                    <td>
                        <a href="">نویسنده</a>
                    </td>
                    <td>
                        <a class="badge badge-primary" href="">دسته اول</a>
                    </td>
                    <td>
                        <a class="badge badge-primary" href="">برچسب اول</a>
                    </td>
                    <td>
                        <a href="#" class="badge tw-px-0"><i class="bi bi-chat-square-text-fill fs-4 me-2"></i> 10</a>
                    </td>
                    <td class="date_column">
                        <a href="">1400/01/01</a>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <a href="{{route('post')}}?action=edit&id=1" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">نوشته دوم</a>
                    </td>
                    <td>
                        <a href="">نویسنده</a>
                    </td>
                    <td>
                        <a class="badge badge-primary" href="">دسته اول</a>
                        <a class="badge badge-primary" href="">دسته اول</a>
                    </td>
                    <td>
                        <a class="badge badge-primary" href="">برچسب اول</a>
                    </td>
                    <td>
                    <a href="#" class="badge tw-px-0"><i class="bi bi-chat-square-text-fill fs-4 me-2"></i> 0</a>
                    </td>
                    <td class="date_column">
                        <a href="">1402/01/01</a>
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

@section('scripts')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endsection