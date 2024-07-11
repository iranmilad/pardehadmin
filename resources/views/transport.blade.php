@extends('layouts.primary')

@if(Route::is('transport.edit.show'))
@section('title', 'ویرایش منطقه حمل و نقل')
@else
@section('title', 'ایجاد منطقه حمل و نقل')
@endif

@section('content')
<form action="" method="post">
    @csrf
    <div class="card mb-10">
        <div class="card-body">
            <div>
                <label for="" class="form-label">عنوان منطقه</label>
                <input type="text" class="form-control form-control-solid" name="title" placeholder="عنوان منطقه را وارد کنید" />
            </div>
        </div>
    </div>
    <div class="card mb-10">
        <div class="card-body">
            <div>
                <label for="" class="form-label">ناحیه ها</label>
                <select data-control="select2" data-placeholder="ناحیه را انتخاب کنید" class="form-select form-select-solid" name="regions[]" id="" multiple>
                    <option value="1">تهران</option>
                    <option value="2">فارس</option>
                    <option value="3">اصفهان</option>
                    <option value="4">خراسان</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">هزینه ها</h4>
        </div>
        <div class="card-body tw-space-y-5" x-data="{ selectedCost: '' }">
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
                    <label for="" class="form-label">هزینه :</label>
                    <div class="input-group">
                        <input dir="ltr" name="price" type="text" class="form-control form-control-solid mb-2 mb-md-0" placeholder="هزینه را وارد کنید" />
                        <span class="input-group-text bg-white ms-0">تومان</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <button class="btn btn-success mt-5">
        ذخیره
    </button>
</form>
@endsection