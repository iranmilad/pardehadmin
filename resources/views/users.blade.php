@extends('layouts.primary')

@section('title', 'کاربران')

@section("toolbar")
<a href="{{route('users.create')}}" class="btn btn-primary">کاربر جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>

        <form action="{{ route('users.bulk_action') }}" method="post">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="bulk-action">
                    <option value="">عملیات</option>
                    <option value="delete">حذف</option>
                    <option value="activate">فعال کردن</option>
                    <option value="deactivate">غیر فعال کردن</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <!--end::Group actions-->
            <table class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                    <th class="w-10px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#users_table .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="cursor-pointer px-0 text-start">نام </th>
                    <th class="px-0 text-start">نام خانوادگی</th>
                    <th class="px-0 text-start">ایمیل</th>
                    <th class="px-0 text-start">نقش</th>
                    <th class="px-0 text-start">نوشته</th>
                    <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" data-id="{{ $user->id }}" />
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('users.profile', ['id' => $user->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">
                        {{ $user->first_name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('users.profile', ['id' => $user->id]) }}" class="text-muted">{{ $user->last_name }}</a>
                    </td>
                    <td>
                        <a href="{{ route('users.profile', ['id' => $user->id]) }}" class="text-primary">{{ $user->email }}</a>
                    </td>
                    <td>
                        <a href="{{ route('users.profile', ['id' => $user->id]) }}" class="text-primary">{{ $user->role->title }}</a>
                    </td>
                    <td>
                        <a href="{{ route('users.profile', ['id' => $user->id]) }}" class="text-primary">{{ $user->posts->count() }}</a>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-light btn-sm">ویرایش</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </form>
        {{ $users->links("vendor.pagination.custom-pagination") }}
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endsection
