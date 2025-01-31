@extends('layouts.primary')

@section('title', 'حلقه محصولات')

@section("toolbar")
<a href="{{ route('products-loop.create') }}" class="btn btn-primary">حلقه جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="{{ route('products-loop.index') }}" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" class="" id="action_form" action="{{ route('products-loop.bulk_action') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="">
                    <option value="">عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="global_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" />
                            </div>
                        </th>
                        <th class="px-0 min-w-175px text-start">عنوان</th>
                        <th class="px-0 min-w-175px text-start">تم</th>
                        <th class="px-0 min-w-175px text-start">تعداد آیتم‌ها</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blockWidgets as $block)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="selected_blocks[]" value="{{ $block->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('products-loop.edit', ['id' => $block->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                                {{ $block->block }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-primary">{{ $block->type }}</span>
                        </td>
                        <td>{{ $block->settings->count ?? 0 }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-info btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                عملیات
                                <span class="svg-icon fs-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M6.707 15.707a1 1 0 0 1-1.414-1.414L11.293 8.293a1 1 0 0 1 1.415.001l6 5.5a1 1 0 0 1-1.414 1.414L12 10.586 6.707 15.707Z"></path>
                                    </svg>
                                </span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ route('products-loop.edit', ['id' => $block->id]) }}" class="menu-link px-3">
                                        ویرایش
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="{{ route('products-loop.delete', ['id' => $block->id]) }}" class="menu-link px-3 text-danger">
                                        حذف
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>


    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
