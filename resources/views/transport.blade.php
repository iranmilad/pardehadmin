@extends('layouts.primary')

@section('title', isset($transport) ? 'ویرایش منطقه حمل و نقل' : 'ایجاد منطقه حمل و نقل')

@section('content')
<form action="{{ isset($transport) ? route('transports.update', $transport->id) : route('transports.store') }}" method="post">
    @csrf
    @if(isset($transport))
        @method('PUT')
    @endif
    <div class="card mb-10">
        <div class="card-body">
            <div>
                <label for="title" class="form-label">عنوان منطقه</label>
                <input type="text" class="form-control form-control-solid" name="title" placeholder="عنوان منطقه را وارد کنید" value="{{ old('title', $transport->title ?? '') }}" />
            </div>
        </div>
    </div>
    <div class="card mb-10">
        <div class="card-body">
            <div>
                <label for="regions" class="form-label">ناحیه ها</label>
                <select data-control="select2" data-placeholder="ناحیه را انتخاب کنید" class="form-select form-select-solid" name="regions[]" id="regions" multiple>
                    @foreach($provinces as $province)
                        <option value="{{ $province }}" {{ isset($transport) && in_array($province, $transport->regions) ? 'selected' : '' }}>{{ $province }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">هزینه ها</h4>
        </div>
        <div class="card-body tw-space-y-5" x-data="{ selectedCost: '{{ old('cost', $transport->cost_type ?? '') }}' }">
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="radio" value="free" id="flexRadioDefault1" name="cost" x-model="selectedCost" />
                <label class="form-check-label" for="flexRadioDefault1">
                    حمل و نقل رایگان
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="radio" value="local" id="flexRadioDefault2" name="cost" x-model="selectedCost" />
                <label class="form-check-label" for="flexRadioDefault2">
                    تحویل محلی
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="radio" value="fixed" id="flexRadioDefault3" name="cost" x-model="selectedCost" />
                <label class="form-check-label" for="flexRadioDefault3">
                    نرخ ثابت
                </label>
            </div>
            <div x-show="selectedCost === 'fixed'">
                <div class="mb-5 col-md-6">
                    <label for="price" class="form-label">هزینه :</label>
                    <div class="input-group">
                        <input dir="ltr" name="price" type="text" class="form-control form-control-solid mb-2 mb-md-0" placeholder="هزینه را وارد کنید" value="{{ old('price', $transport->price ?? '') }}" />
                        <span class="input-group-text bg-white ms-0">تومان</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-end col-3 mt-3">
        <button type="submit" class="btn btn-primary btn-sm">{{ isset($transport) ? 'بروزرسانی' : 'ایجاد' }}</button>
    </div>
</form>
@endsection
