@extends('layouts.primary')

@if(Route::is('customers-group.edit.show'))
@section('title', 'ویرایش گروه')
@else
@section('title', 'ایجاد گروه')
@endif


@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">جزئیات گروه</h4>
        </div>
        <div class="card-body">
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">عنوان گروه</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" placeholder="نام را وارد کنید" name="title">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="" class="col-2 form-label">توضیحات گروه</label>
                <div class="col-10">
                    <textarea class="form-control form-control-solid" rows="6" placeholder="توضیحات را وارد کنید" name="description" id=""></textarea>
                </div>
            </div>
            <label for="" class="col-2 form-label">انتخاب کاربران</label>
            <table id="customer_group_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#customer_group_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نام و نام خانوادگی</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">شماره تلفن</th>
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
                            <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">فرهاد باقری</a>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}">09374039436</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('attribute.show',['id' => 1])}}">مشاهده کاربر</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">فرهاد باقری</a>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}">09374039436</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('attribute.show',['id' => 1])}}">مشاهده کاربر</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">فرهاد باقری</a>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}">09374039436</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('attribute.show',['id' => 1])}}">مشاهده کاربر</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">فرهاد باقری</a>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}">09374039436</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('attribute.show',['id' => 1])}}">مشاهده کاربر</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">فرهاد باقری</a>
                        </td>
                        <td>
                            <a href="{{route('attribute.show',['id' => 1])}}">09374039436</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('attribute.show',['id' => 1])}}">مشاهده کاربر</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endsection