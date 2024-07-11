<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@if(Route::is('attribute.show'))
@section('title', 'ویرایش ویژگی')
@else
@section('title', 'ایجاد ویژگی')
@endif

@section('content')

<!-- PARENT -->
<div class="card mb-8">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی گارانتی</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="title" class="form-label required">عنوان</label>
                            <input type="text" class="form-control" id="title" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="title" class="form-label required">نامک</label>
                            <input type="text" class="form-control" id="title" placeholder="نامک را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="title" class="form-label">لینک راهنما</label>
                            <input type="text" class="form-control" id="title" placeholder="لینک راهنما را وارد کنید">
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
</div>
<!-- PARENT -->

<!-- CHILDREN COLOR -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های فرزند رنگ</h3>
            </div>
        </div>
        <div class="card-body">
            <!-- CHILDREN -->
            <div class="row">
                <div class="color_repeater">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <div data-repeater-list="color_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">عنوان:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نامک:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label" for="">انتخاب رنگ</label>
                                        <input type="hidden" name="option[color]">
                                        <div class="color-picker"></div>
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
<!-- CHILDREN COLOR -->

<!-- PATTERN PATTERN -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های فرزند طرح</h3>
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
                        <div data-repeater-list="pattern_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">عنوان:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" value="کتان" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نامک:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" value="cotton" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label" for="">انتخاب طرح</label>
                                        <div class="choose_file_box">
                                            <button class="choose_file_button" data-choose="single">انتخاب فایل</button>
                                            <input type="hidden" name="option[image]">
                                            <button class="remove_choose_file"><i class="fas fa-times"></i></button>
                                        </div>
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
<!-- PATTERN PATTERN -->

<!-- SIZE PATTERN -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های فرزند سایز</h3>
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
                        <div data-repeater-list="size_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">عنوان:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" value="عرض" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نامک:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" value="width" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label">لینک راهنما:</label>
                                        <input name="option[link]" type="text" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
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
<!-- SIZE PATTERN -->

<!-- OPTION PATTERN -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های فرزند گزینه ای مثل گارانتی</h3>
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
                        <div data-repeater-list="options_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">عنوان:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" value="گارانتی ماهه" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نامک:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" value="1month" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label">لینک راهنما:</label>
                                        <input name="option[link]" type="text" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
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
<!-- OPTION PATTERN -->

<!-- SELECT PATTERN -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های فرزند انتخابی (select)</h3>
            </div>
        </div>
        <div class="card-body">
            <!-- CHILDREN -->
            <div class="row">
                <div class="select_repeater">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <div data-repeater-list="select_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md-6 col-lg-4 col-xl">
                                        <label class="form-label required">عنوان:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" value="نوع موتور" />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl">
                                        <label class="form-label required">نامک:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" value="motor_type" />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl">
                                        <label class="form-label required">ویژگی ها:</label>
                                        <input name="option[options]" type="text" class="form-control mb-2 mb-md-0 select-option" placeholder="ویژگی ها را وارد کنید">
                                        <span class="text-muted fs-7">ویژگی جدید را وارد کنید و Enter را بزنید</span>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl">
                                        <label class="form-label">لینک راهنما:</label>
                                        <input name="option[link]" type="text" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl">
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
<!-- SELECT PATTERN -->

<!-- MOTHER PATTERN -->
<div class="card mb-10">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات ویژگی های مادر مثل پرده رو یا زیر </h3>
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
                                        <label class="form-label required">عنوان:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" value="گارانتی ماهه" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نامک:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" value="1month" />
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

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/custom/pickr/pickr.es5.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    const pickerConfig = {
        el: '.color-picker',
        theme: 'nano', // or 'monolith', or 'nano'

        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 1)',
            'rgba(156, 39, 176,1)',
            'rgba(103, 58, 183,1)',
            'rgba(63, 81, 181, 1)',
            'rgba(33, 150, 243,1)',
            'rgba(3, 169, 244,1)',
            'rgba(0, 188, 212,1)',
            'rgba(0, 150, 136,1)',
            'rgba(76, 175, 80,1)',
            'rgba(139, 195, 74,1)',
            'rgba(205, 220, 57,1)',
            'rgba(255, 235, 59,1)',
            'rgba(255, 193, 7, 1)'
        ],

        components: {

            // Main components
            preview: true,
            opacity: false,
            hue: false,

            // Input / output Options
            interaction: {
                hex: true,
                input: true,
                clear: true,
                cancel: true,
                save: true
            }
        },
        i18n: {
            'btn:save': 'ذخیره',
            'btn:cancel': 'انصراف',
            'btn:clear': 'پاک کردن',
        }
    }
    document.addEventListener("DOMContentLoaded", function() {

        $('.color_repeater').repeater({
            initEmpty: false,
            ready: function(e) {
                new Pickr(pickerConfig).on("save", (color, instance) => {
                    $(instance._root.root).parent().children("input[type='hidden']").val(color.toHEXA().toString())
                    instance.hide();
                })
            },
            show: function() {
                $(this).slideDown();
                const pickr = new Pickr(pickerConfig).on("save", (color, instance) => {
                    $(instance._root.root).parent().children("input[type='hidden']").val(color.toHEXA().toString())
                    instance.hide();
                });
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $(".other_repeater").repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $(".select_repeater").repeater({
            initEmpty: false,
            ready: function() {
                document.querySelectorAll(".select-option").forEach(item => {
                    new Tagify(item);
                })
            },
            show: function() {
                $(this).slideDown();
                let item = $(this).find(".select-option").get(0);
                new Tagify(item);
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    })
</script>
@endsection