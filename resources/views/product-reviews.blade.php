<!-- resources/views/reviews/index.blade.php -->

@extends('layouts.primary')

@section('title', 'دیدگاه ها')

@section('content')
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
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="action">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="product_table_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#product_table_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نویسنده</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">امتیاز</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">محصول</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">تاریخ ثبت</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $review->id }}" />
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('products.reviews.edit', ['id' => $review->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $review->name }}</a>
                            </td>
                            <td>
                                <a href="{{ route('products.reviews.edit', ['id' => $review->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $review->rating }}</a>
                            </td>
                            <td>
                                <a href="{{ route('products.reviews.edit', ['id' => $review->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $review->product->title ?? '' }}</a>
                            </td>
                            <td>{{ $review->dateShamsi }}</td>

                            <td class="text-end">
                                <a href="{{ route('products.reviews.edit', $review->id) }}" class="btn btn-light btn-sm">ویرایش</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $reviews->links("vendor.pagination.custom-pagination") }}
    </div>
</div>

<form class="d-none" method="post" id="delete_form">
    @csrf
    <input name="id" type="hidden">
</form>

@endsection

@section('custom_scripts')
<script>
    $(".btn-delete").on('click', function() {
        let reviewId = $(this).data('id');
        $("#delete_form input[name='id']").val(reviewId);
        $("#delete_form").attr('action', '{{ route("products.reviews.delete") }}');
        $("#delete_form").submit();
    });

    $("#action_form").on('submit', function(e) {
        e.preventDefault();
        let action = $("#action").val();
        if (action === 'delete') {
            let ids = [];
            $("input[name='checked_row[]']:checked").each(function() {
                ids.push($(this).val());
            });
            if (ids.length > 0) {
                $("#delete_form input[name='id']").val(ids.join(','));
                $("#delete_form").attr('action', '{{ route("products.reviews.bulk_action") }}');
                $("#delete_form").submit();
            }
        }
    });
</script>
@endsection
