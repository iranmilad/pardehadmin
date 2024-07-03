@extends('layouts.primary')

@section('title', 'ویرایش قطعه کد')

@section('content')
<form method="post" class="row post-type-row">
    @csrf
    <div class="col-lg-8 col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="row mb-10">
                    <div class="col-6">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" id="title" class="form-control" placeholder="عنوان را وارد کنید" />
                    </div>
                    <div class="col-6">
                        <label for="url" class="form-label">فقط صفحه خاص (خالی برای همه صفحات)</label>
                        <input type="url" class="form-control" placeholder="ادرس صفحه وارد کنید" />
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-6">
                        <div class="">
                            <label for="" class="form-label">مکان قرارگیری</label>
                            <select name="" id="" class="form-control">
                                <option value="">ابتدای هدر</option>
                                <option value="">انتهای هدر</option>
                                <option value="">ابتدای بدنه</option>
                                <option value="">انتهای بدنه</option>
                                <option value="">ابتدای فوتر</option>
                                <option value="">انتهای فوتر</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">اولویت</label>
                        <input type="number" class="form-control" placeholder="اولویت را وارد کنید" />
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label ">ویرایشگر کد</label>
                    <input type="hidden" name="code" id="code">
                    <div id="code-editor" style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-2 mt-5 mt-lg-0">
        <!-- START:STATUS -->
        <div class="card card-flush py-4 mb-5">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>وضعیت</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body pt-0">
                <!--begin::انتخاب2-->
                <select class="form-select mb-2">
                    <option selected value="published">فعال</option>
                    <option value="inactive">غیرفعال</option>
                </select>
                <!--end::انتخاب2-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">وضعیت قطعه کد را تنظیم کنید.</div>
                <!--end::توضیحات-->

            </div>
            <!--end::کارت body-->
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!-- post id -->
                    <button type="submit" name="remove-post" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    <button class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->

    </div>
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
