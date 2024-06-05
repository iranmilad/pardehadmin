<!-- attribute.blade.php -->
<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@if(Route::is('attribute.properties.edit'))
    @section('title', 'ویرایش خصوصیت')
@else
    @section('title', 'ایجاد زیر آیتم ویژگی')
@endif

@section('content')

<!-- فرم برای تعریف خصوصیات جدید -->
<form method="post" action="{{ isset($property) ? route('attribute.properties.update', $property->id) : route('attribute.properties.store') }}">
    @csrf
    @if(isset($property))
        @method('PUT')
        <input type="hidden" name="property_id" value="{{ $property->id }}">
    @endif

    <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">

    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>{{ isset($property) ? 'ویرایش خصوصیت' : 'تعریف خصوصیت جدید برای ' . $attribute->name }}</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- عنوان خصوصیت -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="value" class="form-label required">مقدار</label>
                            <input type="text" class="form-control" name="value" id="value" value="{{ isset($property) ? $property->value : '' }}" placeholder="عنوان خصوصیت را وارد کنید" required>
                        </div>
                    </div>

                    <!-- توضیحات -->
                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="توضیحات خصوصیت را وارد کنید">{{ isset($property) ? $property->description : '' }}</textarea>
                        </div>
                    </div>

                    <!-- تصویر -->
                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="img" class="form-label">تصویر</label>
                            <input name="img" id="img" type="file" class="form-control mb-2 mb-md-0" placeholder="تصویر را وارد کنید">
                            @if(isset($property) && $property->img)
                                <img src="{{ asset($property->img) }}" alt="Attribute Image" style="max-width: 100px; margin-top: 10px;">
                            @endif
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">{{ isset($property) ? 'ویرایش' : 'ذخیره' }}</button>

            </div>
        </div>
    </div>
</form>

@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/pickr/pickr.es5.min.js') }}"></script>
@endsection

@section('scripts')
<script>
    const pickerConfig = {
        el: '.color-picker',
        theme: 'nano',

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
            preview: true,
            opacity: false,
            hue: false,

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
    };

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
    });
</script>
@endsection





{{--

<!-- CHILDREN COLOR for display_type=color-->
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
                        <div data-repeater-list="color_repeater">
                            <div class="mt-3" data-repeater-item>
                                @foreach($attribute->properties as $property)
                                    <div class="form-group row">
                                        <div class="col-12 col-md">
                                            <label class="form-label required">توضیحات:</label>
                                            <input name="description[color]" type="text" class="form-control mb-2 mb-md-0" placeholder="توضیحات را وارد کنید" />
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label" for="">انتخاب رنگ</label>
                                            <input type="hidden" name="value[color]">
                                            <div class="color-picker"></div>
                                        </div>
                                        <div class="col-12 col-md">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                حذف
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
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


<!-- PATTERN PATTERN display_type=material-->
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
                                        <label class="form-label">طرح:</label>
                                        <input name="option[image]" type="file" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
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

<!-- PATTERN PATTERN display_type=size-->
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

<!-- PATTERN PATTERN display_type=options-->
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


<!-- PATTERN PATTERN display_type=model-->
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


<!-- PATTERN PATTERN display_type=priceModel-->
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
<!-- MOTHER PATTERN --> --}}
