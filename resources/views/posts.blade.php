@extends('layouts.primary')

@section('title', 'نوشته ها')

@section("toolbar")
<a href="{{ route('post.create') }}" class="btn btn-primary">نوشته جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <div class="tw-flex tw-items-center tw-justify-between tw-flex-wrap">
            <form action="" method="get">
                @csrf
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                    <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جوی نوشته ها" />
                </div>
            </form>
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center tw-invisible" data-kt-docs-table-toolbar="selected">
                <div class="fw-bold me-5 tw-hidden sm:tw-block">
                    <span class="me-2" data-kt-docs-table-select="selected_count"></span> انتخاب شده
                </div>

                <form action="" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger" name="remove-items" id="remove-items">
                        حذف
                    </button>
                </form>
            </div>
        </div>

        <!--end::Group actions-->
        <table id="posts_table" class="table gy-5 gs-7">
            <thead>
                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                    <th class="w-10px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#posts_table .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>

                    <th class="cursor-pointer px-0 min-w-175px text-start">نویسنده</th>
                    <th class="cursor-pointer px-0 min-w-175px text-start">دسته‌ها</th>
                    <th class="px-0 min-w-100px text-start">برچسب‌ها</th>
                    <th class="px-0 tw-max-w-20 text-start">نظرات</th>
                    <th class="px-0 min-w-100px text-center">وضعیت</th>
                    <th class="px-0 min-w-100px text-end">تاریخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" data-id="{{ $post->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $post->title }}</a>
                        </td>
                        <td>
                            <a href="#">{{ $post->user->first_name .' '.$post->user->last_name ?? 'نامشخص' }}</a>
                        </td>
                        <td>

                            @foreach($post->categories as $category)
                                <a class="badge badge-primary" href="#">{{ $category->name }}</a>
                            @endforeach

                            @if($post->categories->isEmpty())
                                <a class="badge badge-secondary" href="#">بدون دسته بندی</a>
                            @endif

                        </td>
                        <td>
                            @foreach ($post->tags as $tag)
                                <a class="badge badge-primary" href="#">{{ $tag->name }}</a>
                            @endforeach
                        </td>
                        <td>
                            <a href="#" class="badge tw-px-0"><i class="bi bi-chat-square-text-fill fs-4 me-2"></i> {{ $post->commentsCount()}}</a>
                        </td>
                        <td class="text-center">
                            <a href="#" class="badge tw-px-0 "> {{ $post->published ? 'منتشر شده' : 'پیش نویس' }}</a>
                        </td>
                        <td class="date_column">
                            <a href="">{{ $post->dateShamsi }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links('vendor.pagination.custom-pagination') }}


    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endsection
