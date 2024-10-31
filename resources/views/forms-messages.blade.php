@extends('layouts.primary')

@section('title', 'پیام ها')

@section("toolbar")
<a href="{{route('form.create.show')}}" class="btn btn-primary">فرم جدید</a>
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
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select form-select-solid tw-w-max" name="" id="">
                        <option>عملیات</option>
                        <option value="delete">حذف</option>
                    </select>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
                </div>
            </div>

            <div id="filter_collapse" class="collapse">
                <div class="d-flex align-items-end flex-wrap w-100 gap-10">
                    <div>
                        <label class="form-label" for="">از تاریخ</label>
                        <input class="form-control form-control-solid" name="from_date" data-jdp type="text" placeholder="انتخاب کنید">
                    </div>
                    <div>
                        <label class="form-label" for="">تا تاریخ</label>
                        <input class="form-control form-control-solid" name="to_date" data-jdp type="text" placeholder="انتخاب کنید">
                    </div>
                    <div>
                        <label class="form-label" for="">فرم ها</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب کنید" data-control="select2" name="" id="">
                            <option value="1">تماس باما</option>
                            <option value="2">ارسال رزومه</option>
                            <option value="3">فرم تست</option>
                        </select>
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
                </div>
            </div>

            <table id="global_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">فرم</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">تاریخ</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('form.message.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">تماس با شرکت</a>
                        </td>
                        <td>
                            <a href="">تماس باما</a>
                        </td>
                        <td>
                            <span class="badge badge-light fs-6 tw-select-all">12/12/1403</span>
                        </td>
                        <td class="text-end">
                            <a href="{{route('form.message.show',['id' => 1])}}" class="btn btn-light btn-sm">
                                مشاهده
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

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
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection

@section("scripts")
<script>
jalaliDatepicker.startWatch();
</script>
@endsection