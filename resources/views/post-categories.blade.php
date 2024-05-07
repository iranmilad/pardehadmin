<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'دسته ها')

@section("toolbar")
<a href="{{route('post-category')}}?action=add" class="btn btn-primary">نوشته جدید</a>
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
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" data-id="1" />
                            </div>
                        </td>
                        <td>
                            <a href=" {{route('post-category')}}?action=edit&id=1" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">پرده های کتان</a>
                        </td>
                        <td>
                            <span class="text-muted">این یک توضیح کوتاه برای دسته بندی های کتان است</span>
                        </td>
                        <td>
                            <span class="badge badge-primary">cottan-certain</span>
                        </td>
                        <td>
                            2
                        </td>
                        <td class="date_column">
                            <span href="">1400/01/01</span>
                        </td>
                        <td class="text-end">
                            <a href="{{route('post-category')}}?action=edit&id=1" class="btn btn-sm btn-primary">ویرایش</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" data-id="2" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('post-category')}}?action=edit&id=2" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">پرده های کتان</a>
                        </td>
                        <td>
                            <span class="text-muted">این یک توضیح کوتاه برای دسته بندی های کتان است</span>
                        </td>
                        <td>
                            <span class="badge badge-primary">cottan-certain</span>
                        </td>
                        <td>
                            2
                        </td>
                        <td class="date_column">
                            <span href="">1400/01/01</span>
                        </td>
                        <td class="text-end">
                            <a href="{{route('post-category')}}?action=edit&id=2" class="btn btn-sm btn-primary">ویرایش</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <ul class="pagination">
            <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
            <li class="page-item active"><a href="#" class="page-link">1</a></li>
            <li class="page-item"><a href="#" class="page-link">2</a></li>
            <li class="page-item "><a href="#" class="page-link">3</a></li>
            <li class="page-item "><a href="#" class="page-link">4</a></li>
            <li class="page-item "><a href="#" class="page-link">5</a></li>
            <li class="page-item "><a href="#" class="page-link">6</a></li>
            <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
        </ul>
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endsection