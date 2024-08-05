@extends('layouts.primary')

@section('title', 'ویرایش فرآیند')


@section('content')
<form action="" method="post">
    @csrf
    <div class="card mb-10">
        <div class="card-header">
            <h4 class="card-title">اطلاعات فرآیند</h4>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <label for="" class="form-label">نام فرآیند</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" placeholder="نام فرآیند را وارد کنید" class="form-control form-control-solid">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <label for="" class="form-label">توضیحات فرآیند</label>
                </div>
                <div class="col-lg-8">
                    <textarea type="text" rows="5" placeholder="توضیحات فرآیند را وارد کنید" class="form-control form-control-solid"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 tw-flex tw-gap-5">
        <button class="btn btn-icon btn-clear btn-success d-none d-md-block">
            <i class="fa-regular fa-circle-dashed fs-4"></i>
        </button>
        <div class="card tw-w-full">
            <div class="card-header">
                <h4 class="card-title">عملیات</h4>
                <div>
                    <button class="btn btn-danger btn-sm mt-2">حذف</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-10 gap-4">
                    <div class="col-12 col-md-6 col-lg">
                        <select class="form-select form-select-solid" name="" id="">
                            <option value="">ارسال ایمیل</option>
                            <option value="">ارسال کد تخفیف</option>
                            <option value="">افزایش امتیاز</option>
                            <option value="">انتقال به گروه ویژه</option>
                            <option value="">تغییر نقش</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg">
                        <input class="form-control form-control-solid" placeholder="مقدار" />
                    </div>
                </div>
                <div>
                    <label class="form-label ">ویرایشگر کد</label>
                    <input type="hidden" name="code" id="code">
                    <div id="code-editor" style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 tw-flex tw-gap-5">
        <button class="btn btn-icon btn-clear btn-success d-none d-md-block">
            <i class="fa-regular fa-circle-dashed fs-4"></i>
        </button>
        <div class="card tw-w-full">
            <div class="card-header">
                <h4 class="card-title">عملیات</h4>
                <div>
                    <button class="btn btn-danger btn-sm mt-2">حذف</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-10 gap-4">
                    <div class="col-12 col-md-6 col-lg">
                        <select class="form-select form-select-solid" name="" id="">
                            <option value="">ارسال ایمیل</option>
                            <option value="">ارسال کد تخفیف</option>
                            <option value="">افزایش امتیاز</option>
                            <option value="">انتقال به گروه ویژه</option>
                            <option value="">تغییر نقش</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg">
                        <input class="form-control form-control-solid" placeholder="مقدار" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg mb-5">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault">
                            چک باکس
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg mb-5">
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="" id="flexRadioDefault" name="radio" />
                        <label class="form-check-label" for="flexRadioDefault">
                            رادیو 1
                        </label>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg mb-5">
                    <label class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="" name="radio" />
                        <span class="form-check-label">
                            رادیو 2
                        </span>
                    </label>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-5 tw-flex tw-gap-5">
        <button class="btn btn-icon btn-clear btn-info fs-4 d-none d-md-block">
            <i class="fa-regular fa-code-pull-request fs-4"></i>
        </button>
        <div class="card tw-w-full">
            <div class="card-header">
                <h4 class="card-title">شرط</h4>
                <div>
                    <button class="btn btn-danger btn-sm mt-2">حذف</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-10 gap-4">
                    <div class="col-12 col-md-6 col-lg">
                        <select class="form-select form-select-solid" name="" id="">
                            <option value="">سبد خرید کاربر</option>
                            <option value="">کد تخفیف</option>
                            <option value="">امتیاز کاربر</option>
                            <option value="">گروه کاربر</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg">
                        <select class="form-select form-select-solid" name="" id="">
                            <option value="">اگر برابر شود با</option>
                            <option value="">اگر برابر نشود با</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg">
                        <input class="form-control form-control-solid" placeholder="مقدار" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <label for="" class="form-label">نتیحه</label>
                            <select class="form-select form-select-solid" name="" id="">
                                <option value="">ارسال ایمیل</option>
                                <option value="">ارسال کد تخفیف</option>
                                <option value="">افزایش امتیاز</option>
                                <option value="">انتقال به گروه ویژه</option>
                                <option value="">تغییر نقش</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tw-w-auto">
            <select class="form-select form-select" name="" id="" data-control="select2" data-hide-search="true">
                <option value="">عملیات</option>
                <option value="">شرط</option>
            </select>
        </div>
        <div class="col-1">
            <button class="btn btn-dark btn-sm">افزودن</button>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection

@section('script-before')
<script src="{{ asset('/js/ace.js') }}"></script>
<script src="{{ asset('/js/theme-clouds.js') }}"></script>
@endsection

@section('scripts')
<script>
    var editor = ace.edit("code-editor");
    editor.setTheme("ace/theme/clouds");
    // editor change
    editor.getSession().on('change', function() {
        var code = editor.getValue();
        $("#code").val(code);
    });
</script>
@endsection