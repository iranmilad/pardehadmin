@extends('layouts.primary')

@section('title', 'تأمین‌کنندگان')

@section('toolbar')
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">تأمین‌کننده جدید</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" id="action_form" action="{{ route('suppliers.delete') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4 mb-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="action">
                    <option disabled selected>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="suppliers_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#suppliers_table .form-check-input" />
                            </div>
                        </th>
                        <th>نام تأمین‌کننده</th>
                        <th>کاربر مربوطه</th>
                        <th>نوع پرداخت</th>
                        <th>نوع خرید</th>
                        
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $supplier->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-gray-800 text-hover-primary">{{ $supplier->name }}</a>
                        </td>
                        <td>
                            {{ $supplier->user?->name ?? '-' }}
                        </td>
                        <td>
                            {{ $supplier->payment_type }}
                        </td>
                        <td>
                            {{ $supplier->buy_type }}
                        </td>
                        <td class="text-end">
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-light btn-sm">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        {{ $suppliers->links("vendor.pagination.custom-pagination") }}
    </div>
</div>
@endsection
