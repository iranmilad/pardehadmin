@extends('layouts.primary')

@section('title', 'پیام ها')

@section("toolbar")
<a href="{{route('attribute.create.show')}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_message">پیام جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end mb-10" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-10">
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
                        <label class="form-label" for="">بخش</label>
                        <select class="form-select form-select-solid" data-control="select2" name="" multiple id="">
                            <option value="1" selected>مدیریت</option>
                            <option value="2">خیاط</option>
                            <option value="3">تامین کننده</option>
                            <option value="4">مشتری</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="">اولویت</label>
                        <select class="form-select form-select-solid" data-control="select2" name="" multiple id="">
                            <option value="3" selected>کم</option>
                            <option value="2">متوسط</option>
                            <option value="1">زیاد</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="">تاریخ</label>
                        <input class="form-control form-control-solid" placeholder="انتخاب تاریخ" name="date" id="filter_date">
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
                </div>
            </div>

            <table id="messages_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#messages_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">بخش</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">اولویت</th>
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
                            <a href="{{route('message.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">اندازه گیری پرده</a>
                        </td>
                        <td>
                            <a class="badge badge-success" href="{{route('message.show',['id' => 1])}}">مدیریت</a>
                            <a class="badge badge-dark" href="{{route('message.show',['id' => 1])}}">خیاط</a>
                            <a class="badge badge-info" href="{{route('message.show',['id' => 1])}}">تامین کننده</a>
                            <a class="badge badge-secondary" href="{{route('message.show',['id' => 1])}}">مشتری</a>
                        </td>
                        <td>
                            <a class="badge badge-success" href="{{route('message.show',['id' => 1])}}">کم</a>
                            <a class="badge badge-warning" href="{{route('message.show',['id' => 1])}}">متوسط</a>
                            <a class="badge badge-danger" href="{{route('message.show',['id' => 1])}}">زیاد</a>
                        </td>
                        <td>
                            <span>12/12/1403</span>
                        </td>
                        <td class="text-end">
                            <a href="{{route('message.show',['id' => 1])}}" class="btn btn-light btn-sm">
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

<!-- NEW MESSAGE MODAL -->
<div class="modal fade" id="new_message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">پیام جدید</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-5">
                    <div class="col-12">
                        <label class="form-label fw-bold">عنوان</label>
                        <input type="text" class="form-control form-control-solid" placeholder="عنوان پیام">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">بخش</label>
                        <select class="form-select form-select-solid">
                            <option value="">مدیریت</option>
                            <option value="">خیاط</option>
                            <option value="">تامین کننده</option>
                            <option value="">مشتری</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">اولویت</label>
                        <select class="form-select form-select-solid">
                            <option value="">کم</option>
                            <option value="">متوسط</option>
                            <option value="">زیاد</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">متن پیام</label>
                        <textarea class="form-control form-control-solid" name="" id="" rows="5" placeholder="متن پیام را بنویسید"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">ارسال</button>
            </div>
        </form>
    </div>
</div>
<!-- NEW MESSAGE MODAL -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
<script>
    // if someone can remove messages set TRUE OR FALSE;
    // in js/pages/messages initTable we check it
    window['deleteAble'] = true;
</script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;

    flatpickr = $("#filter_date").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
    })
</script>
@endsection