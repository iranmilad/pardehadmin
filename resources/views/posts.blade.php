@extends('layouts.primary')

@section('title', 'نوشته ها')

@section("toolbar")
<a href="{{ route('post.create') }}" class="btn btn-primary">نوشته جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<!-- this box is showed when we wants to edit posts by checkboxes but for more than  -->
<div class="card mb-10 d-none">
    <div class="card-header">
        <div class="w-100 d-flex align-items-center justify-content-between">
            <h4>ویرایش دسته جمعی</h4>
            <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#edit-collapse">
                <i class="fal fa-chevron-down"></i>
            </button>
        </div>
    </div>
    <div class="collapse" id="edit-collapse">
        <div class="card-body">
            <form method="post" action class="row mt-5">
                @csrf
                <div class="col-md-6">
                    <div>
                        <label class="form-label" for="">نوشته ها</label>
                        <select class="form-select " data-control="select2" name="group-edit-products" id="" multiple>
                            <option value="" selected>نوشته شماره 1</option>
                            <option value="" selected>نوشته شماره 2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label" for="">وضعیت نوشته</label>
                        <select class="form-select mb-2">
                            <option selected value="published">انتشار</option>
                            <option value="inactive">پیش نویس</option>
                        </select>
                        <!--end::انتخاب2-->
                        <!--begin::توضیحات-->
                        <div class="text-muted fs-7">وضعیت نوشته را تنظیم کنید.</div>
                        <!--end::توضیحات-->
                    </div>
                    <!--begin::انتخاب2-->
                    <div class="form-check mb-10">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                            فعال بودن دیدگاه ها
                        </label>
                    </div>
                    <div class="tw-max-h-56 tw-overflow-auto tw-pt-1 mb-10">
                        <label class="form-label" for="">دسته ها</label>
                        <ul class="intermediat-checkbox category-list">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="tall" name="category1" />
                                    <label class="form-check-label" for="tall">
                                        دسته ی پرده
                                    </label>
                                </div>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="tall2" name="category1['child1']" />
                                            <label class="form-check-label" for="tall2">
                                                پرده ی اتاق خواب
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="tall3" name="category1['child2']" />
                                            <label class="form-check-label" for="tall3">
                                                پرده ی اتاق نشیمن
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-10">
                        <input class="form-control form-control-solid" value="برچسب 3 , برچسب 2 , برچسب 1" id="post-type-tags" />
                        <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
                    </div>
                    <div class="mb-10">
                        <label class="form-label d-block" for="">تصویر شاخص</label>
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                            <!--begin::نمایش existing avatar-->
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <!--end::نمایش existing avatar-->
                            <!--begin::Tags-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
                                <i class="ki-duotone ki-pencil fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Tags-->
                            <!--begin::انصراف-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <!--end::انصراف-->
                            <!--begin::حذف-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <!--end::حذف-->
                        </div>
                        <!--end::Image in -->
                    </div>
                    <button name="submit" type="submit" class="btn btn-success">بروزرسانی</button>
                    <button name="cancel" type="submit" class="btn btn-secondary">لغو</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
