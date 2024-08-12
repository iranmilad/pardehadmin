@extends('layouts.primary')

@section('title', 'تخفیف ها')

@section("toolbar")
<a href="{{ route('discounts.create') }}" class="btn btn-primary">تخفیف جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="{{ route('discounts.index') }}" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" action="{{ route('discounts.bulk_action') }}" id="action_form">
            @csrf
            <div class="d-flex align-items-center justify-content-start w-100 gap-4">
                <select class="form-select form-select-solid tw-w-max" name="bulk_action" id="bulk_action">
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
                    @foreach($discounts as $discount)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $discount->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('discounts.edit', ['id' => $discount->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $discount->code }}</a>
                        </td>
                        <td>
                            <a href="{{ route('discounts.edit', ['id' => $discount->id]) }}">{{ $discount->discount_type }}</a>
                        </td>
                        <td>
                            <a href="{{ route('discounts.edit', ['id' => $discount->id]) }}">{{ $discount->discount_amount }}</a>
                        </td>
                        <td>
                            <a class="badge badge-success" href="{{ route('discounts.edit', ['id' => $discount->id]) }}">همه</a>
                        </td>
                        <td>
                            {{ $discount->usage_count }} / {{ $discount->usage_limit ?? '∞' }}
                        </td>
                        <td>
                            <a href="{{ route('discounts.edit', ['id' => $discount->id]) }}">{{ $discount->discount_expire_end_shamsi ?? 'بدون انقضا' }}</a>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('discounts.edit', ['id' => $discount->id]) }}" class="btn btn-sm btn-light">
                                ویرایش
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <!--end::Group actions-->
        <ul class="pagination">
            {{ $discounts->links("vendor.pagination.custom-pagination") }}
        </ul>
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
