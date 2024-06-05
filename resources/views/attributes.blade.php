<!-- attributes.blade.php -->
<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@if(Route::is('attributes*'))
    @section('title', ' ویژگی ها')
@else
    @section('title', ' ویژگی ها')
@endif

@section('toolbar')
<a href="{{ route('attributes.create') }}" class="btn btn-primary">دسته ی جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <!--start::Group actions-->
        <form method="post" class="" id="action_form" action="{{ route('attributes.delete') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="" id="">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="attributes_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#attributes_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">عنوان ویژگی</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">توضیح</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نوع نمایش</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">زیر ویژگی</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">محصولات</th>
                        <th class="min-w-100px text-start">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $attribute)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $attribute->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $attribute->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $attribute->description }}</a>
                        </td>
                        <td>
                            <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                                @if ($attribute->display_type=="color")
                                    رنگ
                                @elseif ($attribute->display_type=="size")
                                    سایز
                                @elseif ($attribute->display_type=="material")
                                    جنس
                                @elseif ($attribute->display_type=="model")
                                    مدل
                                @elseif ($attribute->display_type=="priceModel")
                                    مدل قیمت دار
                                @elseif ($attribute->display_type=="value")
                                    مقداری
                                @elseif ($attribute->display_type=="options")
                                    انتخابی
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}">{{ $attribute->countItems() }}</a>
                        </td>
                        <td>
                            <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}">{{ $attribute->countProducts() }}</a>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="btn btn-light btn-sm">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

        {{ $attributes->links("vendor.pagination.custom-pagination") }}
    </div>
</div>
<!-- END:TABLE -->
@endsection
