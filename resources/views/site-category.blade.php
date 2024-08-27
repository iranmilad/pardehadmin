@extends('layouts.primary')

@if(Route::is('create-site-category.show'))
@section('title', 'افزودن دسته')
@else
@section('title', 'ویرایش دسته')
@endif

@section('content')

<form method="post">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-1">
                    <label for="" class="form-label">قیمت </label>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault" />
                        <label class="form-check-label" for="flexSwitchDefault">
                            فعال
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-1">
                    <label for="" class="form-label">قابلیت ها</label>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault" />
                        <label class="form-check-label" for="flexSwitchDefault">
                            فعال
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-1">
                    <label for="" class="form-label">وضعیت انبار</label>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" checked />
                        <label class="form-check-label">
                            فعال
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-1">
                    <label for="" class="form-label">رنگ ها</label>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-solid" data-placeholder="یک گزینه انتخاب کنید" data-control="select2" data-hide-search="false" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                        <option value="1" selected>آبی</option>
                        <option value="2">قرمز</option>
                        <option value="3">سبز</option>
                    </select>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-1">
                    <label for="" class="form-label">سایز ها</label>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-solid" data-placeholder="یک گزینه انتخاب کنید" data-control="select2" data-hide-search="false" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                        <option value="1">کوچک</option>
                        <option value="2">متوسط</option>
                        <option value="3">بزرگ</option>
                    </select>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-1">
                    <label for="" class="form-label">جنس ها</label>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-solid" data-placeholder="یک گزینه انتخاب کنید" data-control="select2" data-hide-search="false" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                        <option value="1" selected>کوچک</option>
                        <option value="2">متوسط</option>
                        <option value="3">بزرگ</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection
@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection

@section("scripts")
<script>
    $('#edit_block_repeater').repeater({
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