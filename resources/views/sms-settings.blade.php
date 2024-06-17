@extends('layouts.primary')

@section('title', 'پیامک')

@section('content')
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-manager-sms-tab" data-bs-toggle="pill" data-bs-target="#pills-manager-sms" type="button" role="tab" aria-controls="pills-manager-sms" aria-selected="false">وضعیت ها</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-webservice-tab" data-bs-toggle="pill" data-bs-target="#pills-webservice" type="button" role="tab" aria-controls="pills-webservice" aria-selected="true">وبسرویس</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-manager-sms" role="tabpanel" aria-labelledby="pills-manager-sms-tab">
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
                    <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                        <select class="form-select form-select-solid tw-w-max" name="" id="">
                            <option>عملیات</option>
                            <option value="delete">حذف</option>
                        </select>
                        <button class="btn btn-primary" type="submit">اجرا</button>
                    </div>

                    <table id="global_table" class="table gy-5 gs-7">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="w-10px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="cursor-pointer px-0 min-w-175px text-start">وضعیت سفارش</th>
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
                                    <a href="{{route('sms-text.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">در انتظار پرداخت</a>
                                </td>
                                <td class="text-end">
                                    <a href="{{route('sms-text.show',['id' => 1])}}" class="btn btn-light btn-sm">
                                        ویرایش
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
    </div>
    <div class="tab-pane fade " id="pills-webservice" role="tabpanel" aria-labelledby="pills-webservice-tab">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group mb-5">
                        <label for="" class="form-label">وبسرویس پیامک</label>
                        <div>
                            <select dir="ltr" data-control="select2" name="service" id="" class="form-select">
                                <option value="1">ippanel.com</option>
                                <option value="2">yektatech.net</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">نام کاربری سرویس</label>
                        <div>
                            <input dir="ltr" type="text" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">کلمه عبور وبسرویس</label>
                        <div>
                            <input dir="ltr" type="text" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">شماره ارسال کننده پیامک</label>
                        <div>
                            <input dir="ltr" type="text" class="form-control" name="sender_phone">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">دامنه سامانه پیامک</label>
                        <div>
                            <input type="url" class="form-control" name="sender_phone">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endsection