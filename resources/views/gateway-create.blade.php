@extends('layouts.primary')

@section('title', 'ایجاد روش پرداخت')

@section('content')

<div x-data="{ selectedMethod: 'cardbycard' }">
    <div class="card mb-10">
        <div class="card-body">
            <div>
                <label for="method" class="form-label">انتخاب روش پرداخت</label>
                <select name="method" id="method" class="form-select form-select-solid" x-model="selectedMethod">
                    <option value="cardbycard">کارت به کارت</option>
                    <option value="online">پرداخت آنلاین</option>
                    <option value="cod">پرداخت در محل</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card" x-show="selectedMethod === 'cardbycard'">
        <div class="card-body">
            <form action="{{ route('gateways.store') }}" method="post">
                @csrf
                <input type="hidden" name="type" value="cardbycard">
                <div>
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید" required>
                </div>
                <h4 class="my-6">اطلاعات حساب بانکی</h4>
                <div class="other_repeater">
                    <div class="form-group">
                        <div data-repeater-list="bank_accounts">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نام بانک:</label>
                                        <input name="bankname" type="text" class="form-control mb-2 mb-md-0" placeholder="نام بانک را وارد کنید" required />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">شماره حساب:</label>
                                        <input name="accountnumber" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره حساب را وارد کنید" required />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label">شماره کارت:</label>
                                        <input name="cardnumber" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره کارت را وارد کنید" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="btn btn-success mt-10" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
    <div class="card" x-show="selectedMethod === 'online'">
        <div class="card-body">
            <form action="{{ route('gateways.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="online">
                <div class="mb-5">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید" required>
                </div>
                <div class="mb-5">
                    <label for="logo" class="form-label">لوگو</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <h4 class="my-6">تنظیمات حساب زرین پال</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">مرچنت کد</label>
                    <div class="col-9">
                        <input name="merchant_code" class="form-control" type="text" placeholder="مرچنت کد را وارد کنید" required>
                    </div>
                </div>
                <h4 class="mb-6 mt-10">تنظیمات عملیات پرداخت</h4>
                <div class="form-group row mb-5">
                    <label class="col-3 col-form-label">پیام پرداخت موفق</label>
                    <div class="col-9">
                        <textarea name="success_message" class="form-control" rows="3">پرداخت با موفقیت انجام شد.</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">پیام پرداخت ناموفق</label>
                    <div class="col-9">
                        <textarea name="failure_message" class="form-control" rows="3">پرداخت ناموفق بود.</textarea>
                    </div>
                </div>
                <button class="btn btn-success mt-10" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
    <div class="card" x-show="selectedMethod === 'cod'">
        <div class="card-body">
            <form action="{{ route('gateways.store') }}" method="post">
                @csrf
                <input type="hidden" name="type" value="cod">
                <div>
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید" required>
                </div>
                <button class="btn btn-success mt-10" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
@endsection

@section('scripts')
<script>
    $(".other_repeater").repeater({
        initEmpty: false,
        show: function() {
            $(this).slideDown();
        },
        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>
@endsection
