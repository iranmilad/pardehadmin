@extends('layouts.primary')

@if(Route::is('worktime.edit.show'))
@section('title', 'ویرایش زمان کاری')
@else
@section('title', 'ایجاد زمان کاری')
@endif


@section('content')

<!-- SIZE PATTERN -->
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
                    <x-advanced-search type="user" label="کاربر" name="user" >
                        <option value="1">فرهاد باقری</option>
                    </x-advanced-search>
                </div>
                @endif
                <div class="col-12 col-md-4">
                    <label class="form-label required">تاریخ :</label>
                    <input name="date" type="text" class="form-control mb-2 mb-md-0 time_picker" placeholder="تاریخ را وارد کنید" />
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
<!-- SIZE PATTERN -->

<button class="btn btn-success">ذخیره</button>

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")

<script>
    window.Date = window.JDate;
    $(".time_picker").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
        mode: "range"
    })
</script>

@endsection