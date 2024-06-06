@extends('layouts.primary')

@section('title', 'پیکربندی محصولات')

@section('content')

<form action="" method="post">
    @csrf
    <div class="card mb-10">
        <div class="card-header">
            <h4 class="card-title">
                انبارداری
            </h4>
        </div>
        <div class="card-body">
            <div class="row g-5">
                <div class="col-12 col-md-6">
                    <label class="form-label">آستانه کم بودن موجودی انبار:</label>
                    <input type="number" class="form-control" name="inventory_threshold" value="5" />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">آستانه تمام شدن موجودی انبار:</label>
                    <input type="number" class="form-control" name="inventory_threshold" value="0" />
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            نمایش تمام شدن موجودی انبار
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                واحد های اندازه گیری
            </h4>
        </div>
        <div class="card-body">
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
                                        <label class="form-label required">واحد:</label>
                                        <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="واحد را وارد کنید" value="متر" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">معادل انگلیسی:</label>
                                        <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="معادل انگلیسی را وارد کنید" value="m" />
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
</form>

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/custom/pickr/pickr.es5.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    $(".other_repeater").repeater({
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