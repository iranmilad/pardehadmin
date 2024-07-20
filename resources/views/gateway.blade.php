@extends('layouts.primary')

@section('title', 'ویرایش روش پرداخت')

@section('content')
<form action="{{ route('gateways.update', $gateway->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="tw-text-left mb-10">
        <a class="btn btn-danger" href="{{ route('gateways.delete', $gateway->id) }}">حذف</a>
    </div>

    @if ($gateway->type == "online")
        <div class="card mt-10">
            <div class="card-header">
                <h4 class="card-title">روش درگاه بانکی</h4>
            </div>
            <div class="card-body">
                <div class="mb-5">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید" value="{{ $gateway->title }}" required>
                </div>
                <div class="mb-5">
                    <label for="logo" class="form-label">لوگو</label>
                    <x-file-input type="single" :preview="false" name="pic" />
                </div>
                <h4 class="my-6">تنظیمات حساب</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">مرچنت کد</label>
                    <div class="col-9">
                        <input name="merchant_code" class="form-control" type="text" value="{{ $gateway->merchant_code }}">
                    </div>
                </div>
                <h4 class="mb-6 mt-10">تنظیمات عملیات پرداخت</h4>
                <div class="form-group row mb-5">
                    <label class="col-3 col-form-label">پیام پرداخت موفق</label>
                    <div class="col-9">
                        <textarea name="success_message" class="form-control" rows="3">{{ $gateway->success_message }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">پیام پرداخت ناموفق</label>
                    <div class="col-9">
                        <textarea name="failure_message" class="form-control" rows="3">{{ $gateway->failure_message }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($gateway->type == "cardbycard")
        <div class="card mt-10">
            <div class="card-header">
                <h4 class="card-title">روش کارت به کارت</h4>
            </div>
            <div class="card-body">
                <div>
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید" value="{{ $gateway->title }}" required>
                </div>
                <h4 class="my-6">اطلاعات حساب بانکی</h4>
                <div class="other_repeater">
                    <div class="form-group">
                        <div data-repeater-list="bank_accounts">
                            @foreach($gateway->bankAccounts as $account)
                                <div class="mt-3" data-repeater-item>
                                    <div class="form-group row">
                                        <div class="col-12 col-md">
                                            <label class="form-label required">نام بانک:</label>
                                            <input name="bank_accounts[{{ $loop->index }}][bankname]" type="text" class="form-control mb-2 mb-md-0" placeholder="نام بانک را وارد کنید" value="{{ $account->bankname }}" required />
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label required">شماره حساب:</label>
                                            <input name="bank_accounts[{{ $loop->index }}][accountnumber]" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره حساب را وارد کنید" value="{{ $account->accountnumber }}" required />
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label">شماره کارت:</label>
                                            <input name="bank_accounts[{{ $loop->index }}][cardnumber]" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره کارت را وارد کنید" value="{{ $account->cardnumber }}" />
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @elseif ($gateway->type == "cod")
        <div class="card mt-10">
            <div class="card-header">
                <h4 class="card-title">روش پرداخت هنگام دریافت</h4>
            </div>
            <div class="card-body">
                <div>
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید" value="{{ $gateway->title }}" required>
                </div>
            </div>
        </div>
    @endif

    <button type="submit" class="mt-10 btn btn-success">ذخیره</button>
</form>
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
