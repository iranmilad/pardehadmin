@extends('layouts.primary')

@section('title', 'ویرایش اسلایدر')

@section('content')
<div class="card">
    <div class="card-body">
        <form class="repeater" method=" post" enctype="multipart/form-data" id="comments_banner">
            @csrf
            <div data-repeater-list="banner_slides">
                <div class="form-group row mt-3" data-repeater-item>
                    <div class="col-md-5">
                        <label class="form-label">لینک:</label>
                        <input name="link" type="text" class="form-control mb-2 mb-md-0" placeholder="لینک را وارد کنید" />
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">تصویر:</label>
                        <input name="file" type="file" class="form-control mb-2 mb-md-0" />
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            حذف
                        </a>
                    </div>
                </div>
            </div>
            <!--begin::Form group-->
            <div class="form-group mt-5">
                <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                    افزودن
                    <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                </a>
            </div>
            <!--end::Form group-->

            <div class="mt-10">
                <button type="submit" class="btn btn-success">ثبت</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection

@section("scripts")
<script>
    $('#slider_banner,#comments_banner').repeater({
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