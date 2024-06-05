@extends('layouts.primary')

@section('title', 'دسته بندی ها')

@section('toolbar')
<a href="{{ route('categories.create') }}" class="btn btn-primary">دسته ی جدید</a>
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
    <form method="post" action="{{ route('categories.bulk_action') }}" id="action_form">
      @csrf
      <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
        <select class="form-select form-select-solid tw-w-max" name="action">
          <option value="">عملیات</option>
          <option value="delete">حذف</option>
        </select>
        <button class="btn btn-primary" type="submit">اجرا</button>
      </div>
      <table id="product_categories_table" class="table gy-5 gs-7">
        <thead>
          <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
            <th class="w-10px">
              <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#product_categories_table .form-check-input" value="1" />
              </div>
            </th>
            <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
            <th class="cursor-pointer px-0 min-w-175px text-start">نامک</th>
            <th class="cursor-pointer px-0 min-w-175px text-start">والد</th>
            <th class="cursor-pointer px-0 min-w-175px text-start">تعداد</th>
            <th class="min-w-100px text-end">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>
              <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="ids[]" value="{{ $category->id }}" />
              </div>
            </td>
            <td>
              <a href="{{ route('categories.edit', $category->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $category->title }}</a>
            </td>
            <td>
              <a href="{{ route('categories.edit', $category->id) }}">{{ $category->alias }}</a>
            </td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}">{{ $category->parent->title ?? '-' }}</a>
            </td>
            <td>
              <span>{{ $category->products->count() }}</span>
            </td>
            <td class="text-end">
              <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-light btn-sm">ویرایش</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </form>
    <!-- Pagination -->
    {{ $categories->links("vendor.pagination.custom-pagination") }}
  </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
