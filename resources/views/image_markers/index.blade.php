@extends('layouts.primary')

@section('title', 'نشانه گذاری عکس')

@section("toolbar")
<a href="{{ route('image-markers.create') }}" class="btn btn-primary">نشانه گذاری جدید</a>
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
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="bulk_action">
                    <option value="">عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="imagemarkers_table" class="table gy-5 gs-7 tw-align-middle">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#imagemarkers_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">تصویر</th>
                        <th class="cursor-pointer px-0 text-start">کد کوتاه</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($imageMarkers as $imageMarker)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $imageMarker->id }}" />
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('image-markers.edit', ['image_marker' => $imageMarker->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                                    <img src="{{ asset( $imageMarker->image_path) }}" class="tw-h-20 tw-rounded-md" />
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-light fs-6 tw-select-all">[marker id="{{ $imageMarker->id }}"]</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('image-markers.edit', ['image_marker' => $imageMarker->id]) }}" class="btn btn-light btn-sm">
                                    ویرایش
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

        {{ $imageMarkers->links('vendor.pagination.custom-pagination') }}
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
