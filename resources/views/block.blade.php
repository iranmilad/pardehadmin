<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'بلاک جدید')

@section('content')

<form method="post" class="row post-type-row">
    @csrf
    <div class="col-lg-12">
        <div class="card card-body">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">ورودی</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">سلکت باکس</label>
                <select class="form-select form-select-solid" aria-label="Select example">
                    <option selected disabled>یک گزینه انتخاب کنید</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
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
            </div>
        </div>
    </div>
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