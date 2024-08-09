<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'تنظمیات')

@section('content')

<form action="" method="post">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="url" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس سایت را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">عنوان سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="عنوان سایت را وارد کنید" value="" />
                </div>
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">متن کپی رایت</label>
                <div class="col-lg-8 col-xl-8">
                    <textarea class="form-control form-control-solid form-control-lg" name="copyright" placeholder="متن کپی رایت را وارد کنید" cols="30" rows="10"></textarea>
                </div>
            </div>
            <!--end::Input group-->

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">ایمیل مدیریت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ایمیل مدیریت را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">متا های سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 global_tag" placeholder="عنوان سایت را وارد کنید" value="" />
                    <span class="text-muted fs-7">متا ها را وارد کنید و Enter را بزنید</span>
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس 1</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس 1 را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس 2</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس 2 را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">تلفن 1</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="تلفن 1 را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">تلفن 2</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="تلفن 2 را وارد کنید" value="" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">کد پستی</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کد پستی را وارد کنید" value="" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس در نقشه</label>
                <div class="col-lg-8">
                    <div id="map" style="height: 300px;"></div>
                    <input type="hidden" id="location-map" name="location" value="35.70222474889245,51.338657483464765">
                    <span class="text-muted">برای تغییر آدرس در محل مورد نظر کلیک کنید</span>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">حالت تعمیرات</label>
                <div class="form-check col-lg-8 col-xl-8">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" data-bs-toggle="collapse" data-bs-target="#maintense" />
                    <label class="form-check-label" for="flexCheckDefault">
                        فعال
                    </label>
                </div>
            </div>
            <div id="maintense" class="collapse">
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">متن تعمیرات</label>
                    <div class="col-lg-8 col-xl-8">
                        <textarea class="form-control form-control-solid form-control-lg" name="maintense" placeholder="متن تعمیرات را وارد کنید" cols="30" rows="10">به زودی برمیگردیم</textarea>
                    </div>
                </div>
                <div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">تاریخ شروع تعمیرات</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="date" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 form-date" placeholder="تاریخ شروع تعمیرات را وارد کنید" value="" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">تاریخ پایان تعمیرات</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="date" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 form-date" placeholder="تاریخ پایان تعمیرات را وارد کنید" value="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mt-5" type="submit">ذخیره تغییرات</button>
</form>

@endsection

@section('script-before')
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;
    $('.form-date').flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i",
        enableTime: true,
        time_24hr: true,
        locale: "fa",
    });
</script>
@endsection