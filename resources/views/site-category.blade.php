@extends('layouts.primary')

@if(Route::is('create-site-category.show'))
@section('title', 'افزودن دسته')
@else
@section('title', 'ویرایش دسته')
@endif

@section('content')

<form method="post">
    @csrf
    <div class="card mb-10">
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

    <!-- MOTHER PATTERN -->
    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>ویژگی های سفارشی</h3>
                </div>
            </div>
            <div class="card-body">
                <!-- CHILDREN -->
                <div class="row">
                    <div class="other_repeater">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <div data-repeater-list="mother_repeater">
                                <div class="mt-3" data-repeater-item>
                                    <div class="form-group row">
                                        <div class="col-12 col-md">
                                            <label class="form-label required">عنوان ویژگی</label>
                                            <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان ویژگی را وارد کنید" value="قابل شستشو" />
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label required">مقادیر:</label>
                                            <input name="option[options]" type="text" class="form-control mb-2 mb-md-0 cs-tagify" placeholder="مقادیر را وارد کنید" value="پودر دستی , پودر ماشینی" />
                                            <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
                                        </div>
                                        <div class="col-12 col-md">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                حذف
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                                افزودن
                                <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                            </a>
                        </div>
                        <!--end::Form group-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MOTHER PATTERN -->
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection
@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection

@section("scripts")
<script>
    $('.other_repeater').repeater({
        initEmpty: false,
        ready: function(e) {
            new Tagify($(e).find(".cs-tagify").get(0), {
                whitelist: [],
                dropdown: {
                    maxItems: 20, // <- mixumum allowed rendered suggestions
                    enabled: 0, // <- show suggestions on focus
                    closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
                    pattern: /^.{1,70}/,
                },
            });
        },
        show: function(e) {
            $(this).slideDown();
            new Tagify($(this).find(".cs-tagify").get(0), {
                whitelist: [],
                dropdown: {
                    maxItems: 20, // <- mixumum allowed rendered suggestions
                    enabled: 0, // <- show suggestions on focus
                    closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
                    pattern: /^.{1,70}/,
                },
            });
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>
@endsection