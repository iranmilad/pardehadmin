<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'دسته ها')

@section("toolbar")
<a href="{{route('postCategories.create')}}" class="btn btn-primary">دسته ی جدید</a>
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

        <!--end::Group actions-->
        <form action="" method="post">
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="" id="">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                    <option value="edit">ویرایش</option>
                    <option value="active">فعال کردن</option>
                    <option value="inactive">غیر فعال کردن</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="post_categories" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#post_categories .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">توضیح</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نامک</th>
                        <th class="px-0 min-w-100px text-start">تعداد</th>
                        <th class="px-0 min-w-100px text-end">تاریخ</th>
                        <th class="px-0 tw-text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" data-id="{{ $category->id }}" />
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('postCategories.edit', ['id' => $category->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $category->name }}</a>
                            </td>
                            <td>
                                <span class="text-muted">{{ $category->description }}</span>
                            </td>
                            <td>
                                <span class="badge badge-primary">{{ $category->slug }}</span>
                            </td>
                            <td>
                                {{ $category->posts_count }}
                            </td>
                            <td class="date_column">
                                <span>{{ \Carbon\Carbon::parse($category->created_at)->format('Y/m/d') }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('postCategories.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-primary">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            {{ $categories->links('vendor.pagination.custom-pagination') }}
        </form>
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endsection
