@extends('layouts.primary')

@section('title', 'بلاک ها')

@section('toolbar')
<a href="{{ route('blocks.create') }}" class="btn btn-primary">بلاک جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="{{ route('blocks.index') }}" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>

        <!--end::Group actions-->
        <form action="{{ route('blocks.bulk_action') }}" method="post">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="bulk_action" id="">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="blocks_table" class="table align-middle table-row-dashed gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#blocks_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-100px text-start">ویجت پایه</th>
                        <th class="px-0 tw-max-w-20 text-start">نوع</th>
                        <th class="px-0 tw-max-w-20 text-start">نام ویجت</th>
                        <th class="px-0 tw-max-w-20 text-start">تاریخ</th>
                        <th class=" text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blocks as $block)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="ids[]" value="{{ $block->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('blocks.edit', ['id' => $block->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $block->widget->name }}</a>
                        </td>
                        <td>
                            <span class="text-muted">{{ $block->type }}</span>
                        </td>
                        <td>
                            <span class="badge badge-light fs-6 tw-select-all">{{ $block->block }}</span>
                        </td>
                        <td>
                            <span class="text-primary">{{ $block->created_at->format('Y/m/d') }}</span>
                        </td>
                        <td class="text-end dropdown">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                عملیات
                                <span class="svg-icon fs-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('blocks.edit', ['id' => $block->id]) }}" class="menu-link px-3">
                                        ویرایش
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('blocks.delete', ['id' => $block->id]) }}" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                        حذف
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $blocks->links("vendor.pagination.custom-pagination") }}
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
