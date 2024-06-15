@extends('layouts.primary')

@if(Route::is('installments.create'))
    @section('title', 'ایجاد پلن')
@else
    @section('title', 'ویرایش پلن')
@endif

@section('content')

<form action="{{ Route::is('installments.create') ? route('installments.store') : route('installments.update', ['id' => $creditPlan->id]) }}" method="POST">
    @csrf
    @if(Route::is('installments.edit'))
        @method('PUT')
    @endif
    <!-- PARENT -->
    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>مشخصات پلن</h4>
                </div>
            </div>
            <div class="card-body">
                <p class="pb-10">اقساط بر اساس مبلغ کل محصول می‌باشد</p>
                <div class="row gy-8">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="name" class="form-label required">عنوان</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="عنوان را وارد کنید" value="{{ old('name', $creditPlan->name ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="installments_count" class="form-label required">تعداد اقساط</label>
                            <input type="number" class="form-control" id="installments_count" name="installments_count" placeholder="تعداد اقساط" value="{{ old('installments_count', $creditPlan->installments_count ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label" for="installment_interval_months">فاصله پرداختی</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="installment_interval_months" name="installment_interval_months" placeholder="0" value="{{ old('installment_interval_months', $creditPlan->installment_interval_months ?? '') }}" required>
                            <span class="input-group-text">روز</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="credit_percentage" class="form-label required">درصد نقدی</label>
                            <input type="text" class="form-control" id="credit_percentage" name="credit_percentage" placeholder="مثال : 30%" value="{{ old('credit_percentage', $creditPlan->credit_percentage ?? '') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PARENT -->

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>شرایط</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-8">
                <div class="col-12 col-md-6 col-lg-4">
                    @if(Route::is('installments.edit'))
                        <x-advanced-search type="user" label="فقط مشتری مجاز" name="allowed_users[]" :multiple="true" :solid="true" :selected="$allowedUsers" />
                    @else
                        <x-advanced-search type="user" label="فقط مشتری مجاز" name="allowed_users[]" :multiple="true" :solid="true" />
                    @endif

                </div>

            </div>

            <div class="row gy-8">
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="checkbox" class="mt-15" name="all_user_allow" id="all_user_allow" checked>
                    <label for="allowed" class="form-label">همه کاربران مجاز هستند</label>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success mt-10">ذخیره</button>
</form>

@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/pickr/pickr.es5.min.js') }}"></script>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(".other_repeater").repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    });
</script>
@endsection
