<!-- supplier.blade.php -->
@extends('layouts.primary')

@if(Route::is('suppliers.edit'))
    @section('title', 'ویرایش تأمین‌کننده')
@else
    @section('title', 'ایجاد تأمین‌کننده جدید')
@endif

@section('content')
    <form method="post" action="{{ isset($supplier) ? route('suppliers.update', $supplier->id) : route('suppliers.store') }}">
        @csrf
        @if(isset($supplier))
            @method('PUT')
        @endif

        <div class="card mb-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ isset($supplier) ? 'ویرایش تأمین‌کننده' : 'افزودن تأمین‌کننده جدید' }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <!-- انتخاب کاربر (مشتری) -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <x-advanced-search type="user" label="مشتری" name="user_id" solid :value="isset($supplier) ? $supplier->user_id : null" />
                            </div>
                        </div>

                        <!-- نام تأمین‌کننده -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">نام تأمین‌کننده</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $supplier->name ?? '') }}" required>
                            </div>
                        </div>

                        <!-- نوع پرداخت -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">نوع پرداخت</label>
                                <select name="payment_type" class="form-control">
                                    <option value="online" {{ (isset($supplier) && $supplier->payment_type === 'online') ? 'selected' : '' }}>آنلاین</option>
                                    <option value="cash" {{ (isset($supplier) && $supplier->payment_type === 'cash') ? 'selected' : '' }}>نقدی</option>
                                    <option value="credit" {{ (isset($supplier) && $supplier->payment_type === 'credit') ? 'selected' : '' }}>اعتباری</option>
                                </select>
                            </div>
                        </div>

                        <!-- مناطق ارسال -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">مناطق ارسال</label>
                                <select data-control="select2" data-placeholder="ناحیه را انتخاب کنید" class="form-select form-select-solid" name="delivery_areas[]" id="delivery_areas" multiple>
                                    @foreach($delivery_areas as $province)
                                        <option value="{{ $province }}" {{ isset($transport) && in_array($province, $transport->regions) ? 'selected' : '' }}>{{ $province }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <!-- نوع خرید -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">نوع خرید</label>
                                <select name="buy_type" class="form-control">
                                    <option value="direct" {{ (isset($supplier) && $supplier->buy_type === 'direct') ? 'selected' : '' }}>مستقیم</option>
                                    <option value="agent" {{ (isset($supplier) && $supplier->buy_type === 'agent') ? 'selected' : '' }}>نمایندگی</option>
                                </select>
                            </div>
                        </div>

                        <!-- دکمه ثبت -->
                        <div class="col-12 mt-4">
                            <button class="btn btn-success" type="submit">{{ isset($supplier) ? 'ویرایش' : 'ذخیره' }}</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
