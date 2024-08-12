@extends('layouts.primary')

@section('title', 'پیام‌ها')

@section('toolbar')
<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_session">پیام جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end mb-10" action="{{ route('sessions.index') }}" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" class="" id="action_form" action="{{ route('sessions.bulk_action') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-10">
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select form-select-solid tw-w-max" name="action" id="action_select">
                        <option value="">عملیات</option>
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
                        <label class="form-label" for="section_filter">بخش</label>
                        <select class="form-select form-select-solid" data-control="select2" name="section[]" multiple id="section_filter">
                            <option value="management">مدیریت</option>
                            <option value="tailor">خیاط</option>
                            <option value="supplier">تامین کننده</option>
                            <option value="customer">مشتری</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="priority_filter">اولویت</label>
                        <select class="form-select form-select-solid" data-control="select2" name="priority[]" multiple id="priority_filter">
                            <option value="low">کم</option>
                            <option value="medium">متوسط</option>
                            <option value="high">زیاد</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="filter_date">تاریخ</label>
                        <input class="form-control form-control-solid" placeholder="انتخاب تاریخ" name="date" id="filter_date">
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
                </div>
            </div>

            <table id="sessions_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#sessions_table .form-check-input" value="1" />
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
                    @foreach($sessions as $session)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $session->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $session->title }}</a>
                        </td>
                        <td>
                            <a class="badge badge-success" href="{{ route('sessions.edit', ['id' => $session->id]) }}">{{ $session->memberList->title }}</a>
                        </td>
                        <td>
                            <a class="badge badge-{{ $session->priority_badge }}" href="{{ route('sessions.edit', ['id' => $session->id]) }}">{{ $session->priority }}</a>
                        </td>
                        <td>
                            <span>{{ $session->create_at_shamsi }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sessions.edit', ['id' => $session->id]) }}" class="btn btn-light btn-sm">مشاهده</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        {{ $sessions->links() }}

    </div>
</div>
<!-- END:TABLE -->


<!-- NEW SESSION MODAL -->
<div class="modal fade" id="new_session" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sessions.store') }}" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">جلسه جدید</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-5">
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="mb-3">
                            <label for="department" class="form-label">بخش</label>
                            <select class="form-select" name="department" id="department">

                                @foreach ($memberLists as $member)
                                    <option value="{{ $member->id }}">{{ $member->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-6">
                        <div class="mb-3">
                            <label for="priority" class="form-label">اولویت</label>
                            <select class="form-select" name="priority" id="priority">
                                <option value="1">زیاد</option>
                                <option value="2" selected>متوسط</option>
                                <option value="3">کم</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="عنوان جلسه">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="message" class="form-label">متن پیام</label>
                            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="hidden" id="new-session-file" name="file" value="">
                        <button type="button" class="btn custom-btn-dark rounded-pill tw-max-w-max px-3" id="new-session-file-btn">
                            <i class="fa-regular fa-file-import"></i> آپلود فایل
                        </button>
                        <button type="submit" class="btn custom-btn-primary rounded-pill tw-max-w-max px-3">ثبت جلسه</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </form>
    </div>
</div>
<!-- NEW SESSION MODAL -->

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
<script>
    // if someone can remove sessions set TRUE OR FALSE;
    // in js/pages/sessions initTable we check it
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
