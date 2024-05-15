<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@if(Route::is('attribute.show'))
@section('title', 'ویرایش ویژگی')
@else
@section('title', 'ایجاد ویژگی')
@endif

@section('content')

<form action="">
    <!-- PARENT -->
    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>مشخصات پلن</h4>
                </div>
            </div>
            <div class="card-body">
                <p class="pb-10">اقساط بر اساس مبلغ کل محصول میباشد</p>
                <form action="">
                    <div class="row gy-8">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div>
                                <label for="title" class="form-label required">عنوان</label>
                                <input type="text" class="form-control" id="title" placeholder="عنوان را وارد کنید">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div>
                                <label for="title" class="form-label required">تعداد اقساط</label>
                                <input type="text" class="form-control" id="title" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="form-label" for="">فاصله پرداختی</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">روز</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div>
                                <label for="title" class="form-label required">درصد نقدی</label>
                                <input type="text" class="form-control" id="title" placeholder="مثال : 30%">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- PARENT -->

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>شرایط</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-8">
                <div class="col-12 col-md-6 col-lg-4">
                    <x-advanced-search type="user" label="مشتری مجاز" name="user" />
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <x-advanced-search type="user" label="مشتری به جز" name="user" />
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success mt-10">ذخیره</button>
</form>


@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/custom/pickr/pickr.es5.min.js')}}"></script>
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