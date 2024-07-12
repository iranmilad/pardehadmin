@extends('layouts.primary')

@section('title', 'زمان های کاری')

@section('toolbar')
<a href="{{ route('worktimes.create') }}" class="btn btn-primary">افزودن زمان کاری</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="{{ route('worktimes.index') }}" method="get">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" id="action_form">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="action">
                    <option value="">عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="worktimes_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#worktimes_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">کاربر</th>
                        <th class="cursor-pointer px-0 text-start">شماره تلفن</th>
                        <th class="cursor-pointer px-0 text-start">نقش کاربر</th>
                        <th class="cursor-pointer px-0 text-start">کل زمان تنظیم‌شده در ماه جاری</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $user->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('worktimes.edit', $user->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $user->full_name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('worktimes.edit', $user->id) }}">{{ $user->mobile }}</a>
                        </td>
                        <td>
                            <a href="{{ route('worktimes.edit', $user->id) }}">{{ $user->role->title }}</a>
                        </td>
                        <td>
                            <a href="{{ route('worktimes.edit', $user->id) }}">{{ $user->current_month_hours }} ساعت</a>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('worktimes.edit', $user->id) }}" class="btn btn-light btn-sm">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <ul class="pagination">
            {{ $users->links("vendor.pagination.custom-pagination") }}
        </ul>
    </div>
</div>
@endsection
