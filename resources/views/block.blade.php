@extends('layouts.primary')

@section('title', isset($block) ? 'ویرایش بلاک' : 'بلاک جدید')

@section('content')
<form method="post" action="{{ isset($block) ? route('blocks.update', $block->id) : route('blocks.store') }}" class="row post-type-row">
    @csrf
    @if(isset($block))
        @method('PUT')
    @endif
    <div class="col-lg-12">
        <div class="card card-body">
            <div class="mb-10">
                <label for="widget" class="required form-label">ویجت پایه</label>
                <select class="form-select form-select-solid" aria-label="Select widget" name="widget_id" id="widget" required>
                    <option selected disabled>یک گزینه انتخاب کنید</option>
                    @foreach ($widgets as $widget)
                        <option value="{{ $widget->id }}" {{ isset($block) && $block->widget_id == $widget->id ? 'selected' : '' }}>{{ $widget->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-10">
                <label for="setup" class="required form-label">تنظیم ویجت</label>
                <select class="form-select form-select-solid" aria-label="Select setup" name="setup" id="setup" required>
                    <option selected disabled>یک گزینه انتخاب کنید</option>
                </select>
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">سلکت 2</label>
                <select class="form-select form-select-solid" data-placeholder="یک گزینه انتخاب کنید" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="mb-10">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">
                        چک باکس
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">
                        چک باکس 2
                    </label>
                </div>
            </div>
            <div class="mb-10">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" value="" id="flexCheckDefault1" name="radio2">
                    <label class="form-check-label" for="flexCheckDefault1">
                        رادیو
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="flexCheckChecked1" name="radio2" checked="">
                    <label class="form-check-label" for="flexCheckChecked1">
                        رادیو 2
                    </label>
                </div>
            </div>
            <div class="mb-10">
                <!--begin::Repeater-->
                <div id="edit_block_repeater">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="edit_block_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="form-label">عنوان:</label>
                                        <input name="option[title]" type="text" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">تصویر:</label>
                                        <x-file-input type="single" :preview="false" name="pic" />
                                    </div>
                                    <div class="col-md-4">
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
            <div id="setup-options">
                <!-- Setup options will be populated here -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group mt-5">
            <button type="submit" class="btn btn-primary btn-sm">{{ isset($block) ? 'بروزرسانی' : 'ایجاد' }}</button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var widgetSelect = document.getElementById('widget');
    var setupSelect = document.getElementById('setup');
    var setupOptionsContainer = document.getElementById('setup-options');

    // Populate widget select options
    widgetSelect.addEventListener('change', function () {
        var selectedWidget = this.value;
        var widgets = @json($widgets);
        var setupData = JSON.parse(widgets.find(widget => widget.id == selectedWidget).setup);

        setupSelect.innerHTML = '<option selected disabled>یک گزینه انتخاب کنید</option>';
        for (var option in setupData) {
            var opt = document.createElement('option');
            opt.value = option;
            opt.textContent = setupData[option]['l'];
            setupSelect.appendChild(opt);
        }

        // If block is set and setup is available, set the default value
        @if(isset($block))
            var blockSetup = @json($block->type);
            if (blockSetup) {
                setupSelect.value = blockSetup;
                setupSelect.dispatchEvent(new Event('change'));
            }
        @endif
    });

    // Populate setup options
    setupSelect.addEventListener('change', function () {
        var selectedSetup = this.value;
        var widgets = @json($widgets);
        var setupData = JSON.parse(widgets.find(widget => widget.id == widgetSelect.value).setup);
        var inputs = setupData[selectedSetup]['i'];

        setupOptionsContainer.innerHTML = ''; // Clear previous options

        // Parse the block settings if available
        @if(isset($block))
            var blockSettings = @json($block->settings);
            blockSettings = JSON.parse(blockSettings);
        @else
            var blockSettings = {};
        @endif

        // Populate setup options inputs
        for (var inputName in inputs) {
            var inputType = inputs[inputName].split('|')[0];
            var inputValue = inputs[inputName].split('|')[1];

            // Check if input has 'f' flag (fixed value), if yes, skip it
            if (inputType === 'f') {
                continue;
            }

            var label = document.createElement('label');
            label.textContent = inputName;
            label.classList.add('required', 'form-label');

            var input;

            // Set input type based on inputType
            switch (inputType) {
                case 't':
                    input = document.createElement('input');
                    input.type = 'text';
                    input.name = inputName;
                    input.value = blockSettings[inputName] !== undefined ? blockSettings[inputName] : inputValue ;
                    input.classList.add('form-control', 'form-control-solid');
                    break;
                case 'n':
                    input = document.createElement('input');
                    input.type = 'number';
                    input.name = inputName;
                    input.value = blockSettings[inputName] !== undefined ? blockSettings[inputName] : inputValue;
                    input.classList.add('form-control', 'form-control-solid');
                    break;
                case 'c':
                    input = document.createElement('input');
                    input.type = 'checkbox';
                    input.name = inputName;
                    input.classList.add('form-check-input');
                    input.checked = blockSettings[inputName] !== undefined ? blockSettings[inputName] === 'true' ||  blockSettings[inputName] === 'on' ||  blockSettings[inputName] == true : inputValue === 1;
                    break;
                case 'o':
                    input = document.createElement('select');
                    input.name = inputName;
                    input.classList.add('form-select', 'form-select-solid');
                    inputValue.split(':').forEach(function(option) {
                        var opt = document.createElement('option');
                        opt.value = option;
                        opt.textContent = option;
                        input.appendChild(opt);
                    });
                    if (blockSettings[inputName] !== undefined) {
                        input.value = blockSettings[inputName];
                    }
                    break;
                default:
                    continue;
            }

            var divInput = document.createElement('div');
            divInput.classList.add('mb-10');
            divInput.appendChild(label);
            divInput.appendChild(input);
            setupOptionsContainer.appendChild(divInput);
        }
    });

    // Trigger change event on widget select to populate setup options
    if (widgetSelect.value) {
        widgetSelect.dispatchEvent(new Event('change'));
    }

    // Handle setting default values after setup is selected
    @if(isset($block))
        setupSelect.addEventListener('change', function () {
            var blockSettings = @json($block->settings);
            var inputs = setupOptionsContainer.querySelectorAll('input, select');

            inputs.forEach(function (input) {
                var inputName = input.name;

                if (blockSettings[inputName] !== undefined) {
                    switch (input.type) {
                        case 'checkbox':
                            input.checked = blockSettings[inputName] === 'true';
                            break;
                        case 'select-one':
                            input.value = blockSettings[inputName];
                            break;
                        default:
                            input.value = blockSettings[inputName];
                            break;
                    }
                }
            });
        });
    @endif
});
</script>
@endsection



{{-- <div class="mb-10">
    <label for="exampleFormControlInput1" class="required form-label">ورودی</label>
    <input type="text" class="form-control form-control-solid" placeholder="" />
</div> --}}
{{-- <div class="mb-10">
    <label for="exampleFormControlInput1" class="required form-label">نوع ویجت</label>
    <select class="form-select form-select-solid" data-placeholder="یک گزینه انتخاب کنید" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>
</div> --}}
{{-- <div class="mb-10">
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
        <label class="form-check-label" for="flexCheckDefault">
            چک باکس
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
        <label class="form-check-label" for="flexCheckDefault">
            چک باکس 2
        </label>
    </div>
</div>
<div class="mb-10">
    <div class="form-check mb-3">
        <input class="form-check-input" type="radio" value="" id="flexCheckDefault1" name="radio2">
        <label class="form-check-label" for="flexCheckDefault1">
            رادیو
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" value="" id="flexCheckChecked1" name="radio2" checked="">
        <label class="form-check-label" for="flexCheckChecked1">
            رادیو 2
        </label>
    </div>
</div>
<div class="mb-10">
    <!--begin::Repeater-->
    <div id="edit_block_repeater">
        <!--begin::Form group-->
        <div class="form-group">
            <div data-repeater-list="edit_block_repeater">
                <div class="mt-3" data-repeater-item>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="form-label">عنوان:</label>
                            <input name="option[title]" type="text" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">تصویر:</label>
                            <input name="option[image]" type="file" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
                        </div>
                        <div class="col-md-4">
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
    <!--end::Repeater-->
</div> --}}
