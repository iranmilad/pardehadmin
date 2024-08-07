<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@if(Route::is('installment.show'))
@section('title', 'ویرایش قسط')
@else
@section('title', 'ایجاد قسط')
@endif

@section('content')

<form action="">
    <!-- PARENT -->
    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>مشخصات قسط</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row gy-8">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div>
                                <label for="title" class="form-label required">عنوان</label>
                                <input type="text" class="form-control" id="title" placeholder="عنوان را وارد کنید">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <x-advanced-search type="order" label="سفارش" name="order" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <x-advanced-search type="user" label="کاربر" name="user" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label required" for="">تاریخ سر رسید</label>
                            <input type="text" class="form-control date_picker">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label" for="">تاریخ پرداخت</label>
                            <input type="text" class="form-control date_picker">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div>
                                <label for="title" class="form-label required">نوع پرداخت</label>
                                <select class="form-select" name="" id="">
                                    <option value="1">درگاه پرداخت</option>
                                    <option value="2">حضوری</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label" for="">کد پیگیری</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- PARENT -->

    <button class="btn btn-success mt-10">ذخیره</button>
</form>


@endsection

@section('script-before')
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jalali-moment.browser.js')}}"></script>
@endsection

@section("scripts")
<script>
    flatpickr = $(".date_picker").flatpickr({
        disableMobile: "true",
        altInput: true,
        dateFormat: "YYYY-MM-DD",
        altFormat: "DD-MM-YYYY",
        locale: "fa",
        parseDate: (datestr, format) => {
            return moment(datestr, format, true).toDate();
        },
        formatDate: (date, format, locale) => {
            // locale can also be used
            console.log(format)
            return moment(date).locale('fa').format(format);
        }
    })
</script>
@endsection
