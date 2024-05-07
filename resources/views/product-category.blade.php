<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ویرایش دسته بندی')

@section('content')

<!-- PARENT -->
<div class="card mb-8">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h3>دسته مادر</h3>
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
              <label for="title" class="form-label">تصویر</label>
              <input class="form-control" type="file" name="file" id="">
            </div>
          </div>
        </div>
        <button class="btn btn-success" type="submit">ذخیره</button>
      </form>
    </div>
  </div>
</div>
<!-- PARENT -->

<!-- CHILDREN -->
<div class="card mb-10">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h3>دسته های فرزند</h3>
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
                    <input name="option[name]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" value="" />
                  </div>
                  <div class="col-12 col-md">
                    <label class="form-label required">نامک:</label>
                    <input name="option[slug]" type="text" class="form-control mb-2 mb-md-0" placeholder="نامک را وارد کنید" value="" />
                  </div>
                  <div class="col-12 col-md">
                    <label class="form-label">تصویر:</label>
                    <input name="option[image]" type="file" class="form-control mb-2 mb-md-0" placeholder="وارد کنید" />
                  </div>
                  <div class="col-12 col-md-2">
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
<!-- CHILDREN -->

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection

@section("scripts")
<script>
  document.addEventListener("DOMContentLoaded", function() {
    $(".other_repeater").repeater({
      initEmpty: false,
      show: function() {
        $(this).slideDown();
      },

      hide: function(deleteElement) {
        $(this).slideUp(deleteElement);
      }
    });
  })
</script>
@endsection