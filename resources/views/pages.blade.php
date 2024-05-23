@extends('layouts.primary')

@section('title', 'برگه‌ها')

@section('toolbar')
<a href="{{ route('pages.create') }}" class="btn btn-primary">برگه جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form action="{{ route('pages.bulk_action') }}" method="post" id="action_form">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4 mb-3">
                <select class="form-select form-select-solid tw-w-max" name="action" id="bulk_action">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

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
                    @foreach ($pages as $page)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_rows[]" value="{{ $page->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('pages.edit', ['id' => $page->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ $page->title }}</a>
                        </td>
                        <td>
                            <span class="text-muted">{{ $page->user->first_name.' '.$page->user->last_name }}</span>
                        </td>
                        <td>
                            <span class="text-primary">{{ $page->dateShamsi }}</span>
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-light" href="{{ route('pages.edit', ['id' => $page->id]) }}">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $pages->links("vendor.pagination.custom-pagination") }}
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
