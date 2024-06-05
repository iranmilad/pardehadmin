@extends('layouts.primary')

@section('title', 'برچسب ها')

@section('toolbar')
<a href="{{ route('products.tags.create') }}" class="btn btn-primary">برچسب جدید</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="" method="get">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" id="action_form">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action">
                <option value="">عملیات</option>
                <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="product_tags_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#product_tags_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="px-0 min-w-175px text-start">عنوان</th>
                        <th class="px-0 min-w-175px text-start">نامک</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $tag->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('products.tags.edit', $tag->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $tag->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('products.tags.edit', $tag->id) }}">{{ $tag->slug }}</a>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('products.tags.edit', $tag->id) }}" class="btn btn-light btn-sm">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <div class="d-flex justify-content-between">
            <div>
                {{ $tags->links("vendor.pagination.custom-pagination") }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
