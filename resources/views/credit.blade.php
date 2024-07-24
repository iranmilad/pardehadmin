@extends('layouts.primary')

@if(Route::is('credits.edit'))
@section('title', 'ویرایش قسط')
@else
@section('title', 'ایجاد قسط')
@endif

@section('content')

<form action="{{ Route::is('credits.edit') ? route('credits.update', $credit->id) : route('credits.store') }}" method="POST">
    @csrf
    @if(Route::is('credits.edit'))
        @method('PUT')
    @endif

    <!-- PARENT -->
    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>مشخصات قسط</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-8">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="ammount" class="form-label required">مبلغ</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount', $credit->amount ?? '') }}" placeholder="مبلغ قسط را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        @if(Route::is('credits.edit'))
                        <x-advanced-search type="order" label="سفارش" :multiple="false" name="order" :selected="$selectedOrder"/>
                        @else
                        <x-advanced-search type="order" label="سفارش" :multiple="false" name="order"/>
                        @endif
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label required" for="due_date">تاریخ سر رسید</label>
                        <input type="text" class="form-control date_picker" id="due_date" name="due_date" value="{{ old('due_date', $credit->dueDateShamsi ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label" for="updated_at">تاریخ پرداخت</label>
                        <input type="text" class="form-control date_picker" id="updated_at" name="updated_at" value="{{ old('updated_at', $credit->payment->payedDateShamsi ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="payment_method" class="form-label required">نوع پرداخت</label>
                            <select class="form-select" name="payment_method" id="payment_method">
                                <option value="bank" {{ old('payment_method', $credit->payment->payment_method ?? '') == "bank" ? 'selected' : '' }}>درگاه پرداخت</option>
                                <option value="cash" {{ old('payment_method', $credit->payment->payment_method ?? '') == "cash" ? 'selected' : '' }}>نقدی</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label" for="tracking_code">کد پیگیری</label>
                        <input type="text" class="form-control" id="ref_id" name="ref_id" value="{{ old('tracking_code', $credit->payment->ref_id ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PARENT -->

    <button class="btn btn-success mt-10">{{ Route::is('credits.show') ? 'ویرایش' : 'ذخیره' }}</button>
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
