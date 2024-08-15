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
                                @if(isset($property) && $property->img)
                                    <x-file-input type="single" :preview="false" name="img" value="{{ $property->img }}" />
                                @else
                                    <x-file-input type="single" :preview="false" name="img" />
                                @endif



                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">{{ isset($property) ? 'ویرایش' : 'ذخیره' }}</button>
                    </div>

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



