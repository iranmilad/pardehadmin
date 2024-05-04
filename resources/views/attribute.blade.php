<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ویرایش ویژگی')

@section('content')

<!-- PARENT -->
<div class="card mb-8">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" class="form-control" id="title" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">نامک</label>
                            <input type="text" class="form-control" id="title" placeholder="نامک را وارد کنید">
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
</div>
<!-- PARENT -->

<!-- CHILDREN -->
<div class="card">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های فرزند</h3>
            </div>
        </div>
        <div class="card-body">
            <!-- CHILDREN -->
            <table id="attribute_table" class="table align-middle table-row-dashed gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#attribute_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-100px text-start">عنوان</th>
                        <th class="px-0 tw-max-w-20 text-start">نامک</th>
                        <th class=" text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" data-id="1" />
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1 title-attr">آبی</span>
                        </td>
                        <td>
                            <span class="text-muted slug-attr">blue</span>
                        </td>
                        <td class="text-end dropdown">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                عملیات
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a class="menu-link edit_item px-3" data-id="1">
                                        ویرایش
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                        حذف
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" data-id="1" />
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1 title-attr">سبز</span>
                        </td>
                        <td>
                            <span class="text-muted slug-attr">green</span>
                        </td>
                        <td class="text-end dropdown">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                عملیات
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a class="menu-link edit_item px-3" data-id="2">
                                        ویرایش
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                        حذف
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="edit_modal">
    <div class="modal-dialog">
        <form method="post" action="{{route('attribute.children.save',['id' => 1])}}" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="child_title" class="form-label">عنوان</label>
                            <input name="child_title" type="text" class="form-control" id="child_title" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="child_slug" class="form-label">نامک</label>
                            <input name="child_slug" type="text" class="form-control" id="child_slug" placeholder="نامک را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="child_slug" class="form-label">نوع</label>
                            <select class="form-select" name="" id="">
                                <option value="">رنگ</option>
                                <option value="">طرح</option>
                                <option value="">طول و عرض</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="child_id" id="child_id">
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>
        </form>
    </div>
</div>

@endsection