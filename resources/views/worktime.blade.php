@extends('layouts.primary')

@if(Route::is('worktime.edit.show'))
@section('title', 'ویرایش زمان کاری')
@else
@section('title', 'ایجاد زمان کاری')
@endif


@section('content')

<form action="" method="post">
    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>زمان های انجام کار</h4>
                </div>
            </div>
            <div class="card-body">
                <!-- CHILDREN -->
                <div class="form-group row">
                    @if(Route::is('worktime.create.show'))
                    <div class="col-12 col-md-4">
                        <x-advanced-search type="user" label="کاربر" name="user" />
                    </div>
                    @else
                    <div class="col-12 col-md-4">
                        <x-advanced-search type="user" label="کاربر" name="user">
                            <option value="1">فرهاد باقری</option>
                        </x-advanced-search>
                    </div>
                    @endif
                    <div class="col-12 col-md-4">
                        <label class="form-label required">تاریخ :</label>
                        <input name="date" type="text" class="form-control mb-2 mb-md-0 " data-jdp placeholder="تاریخ را وارد کنید" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label required">زمان مورد نیاز :</label>
                        <div class="input-group">
                            <input dir="ltr" name="hour" type="number" min="1" max="24" class="form-control mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" />
                            <span class="input-group-text">ساعت</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-10">
        <div class="card-header">
            <h4 class="card-title">خلاصه زمان های کاربر</h4>
        </div>
        <div class="card-body">

            <table id="global_table" class="table table-striped gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="cursor-pointer text-start">روز</th>
                        <th class="cursor-pointer text-start">زمان</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="text-primary tw-font-medium">12/12/1403</span>
                        </td>
                        <td>
                            <span class="text-primary tw-font-medium">2 ساعت</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="text-primary tw-font-medium">12/12/1403</span>
                        </td>
                        <td>
                            <span class="text-primary tw-font-medium">2 ساعت</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <button class="btn btn-success">ذخیره</button>
</form>

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection

@section("scripts")

<script>
    jalaliDatepicker.startWatch();
</script>

@endsection