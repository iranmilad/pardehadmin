@extends('layouts.primary')

@section('title', 'تنظمیات')

@section('content')

<form action="{{ route('settings.update','general') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <!-- فیلدهای فرم تنظیمات مشابه فرم موجود در سوال -->
            <!-- برای ویرایش، مقدار اولیه فیلدها را از $setting بگیرید -->
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">لوگو</label>
                <div class="col-lg-8 col-xl-8">
                    <x-file-input type="single" :preview="true" name="settings[logo]" value="{{ $setting->settings['logo'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">فاوآیکون</label>
                <div class="col-lg-8 col-xl-8">
                    <x-file-input type="single" :preview="true" name="settings[favicon]" value="{{ $setting->settings['favicon'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="url" name="settings[site_url]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس سایت را وارد کنید" value="{{ $setting->settings['site_url'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">عنوان سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[site_title]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="عنوان سایت را وارد کنید" value="{{ $setting->settings['site_title'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">متن کپی رایت</label>
                <div class="col-lg-8 col-xl-8">
                    <textarea class="form-control form-control-solid form-control-lg" name="settings[copyright]" placeholder="متن کپی رایت را وارد کنید" cols="30" rows="10">{{ $setting->settings['copyright'] ?? '' }}</textarea>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">ایمیل مدیریت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[admin_email]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ایمیل مدیریت را وارد کنید" value="{{ $setting->settings['admin_email'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">متا های سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[meta_tags]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 global_tag" placeholder="متا های سایت را وارد کنید" value="{{ $setting->settings['meta_tags'] ?? '' }}" />
                    <span class="text-muted fs-7">متا ها را وارد کنید و Enter را بزنید</span>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس 1</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[address_1]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس 1 را وارد کنید" value="{{ $setting->settings['address_1'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس 2</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[address_2]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس 2 را وارد کنید" value="{{ $setting->settings['address_2'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">تلفن 1</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[phone_1]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="تلفن 1 را وارد کنید" value="{{ $setting->settings['phone_1'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">تلفن 2</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[phone_2]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="تلفن 2 را وارد کنید" value="{{ $setting->settings['phone_2'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">کد پستی</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="settings[postal_code]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کد پستی را وارد کنید" value="{{ $setting->settings['postal_code'] ?? '' }}" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس در نقشه</label>
                <div class="col-lg-8">
                    <div id="map" style="height: 300px;"></div>
                    <input type="hidden" id="location-map" name="settings[location]" value="{{ $setting->settings['location'] ?? '35.70222474889245,51.338657483464765' }}">
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">حالت تعمیرات</label>
                <div class="form-check col-lg-8 col-xl-8">
                    <input class="form-check-input" type="checkbox" name="settings[maintenance_mode]" id="flexCheckDefault" data-bs-toggle="collapse" data-bs-target="#maintense" {{ isset($setting->settings['maintenance_mode']) && $setting->settings['maintenance_mode'] ? 'checked' : '' }} />
                    <label class="form-check-label" for="flexCheckDefault">
                        فعال
                    </label>
                </div>
            </div>
            <div id="maintense" class="collapse {{ isset($setting->settings['maintenance_mode']) && $setting->settings['maintenance_mode'] ? 'show' : '' }}">
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">متن تعمیرات</label>
                    <div class="col-lg-8 col-xl-8">
                        <textarea class="form-control form-control-solid form-control-lg" name="settings[maintenance_message]" placeholder="متن تعمیرات را وارد کنید" cols="30" rows="10">{{ $setting->settings['maintenance_message'] ?? 'به زودی برمیگردیم' }}</textarea>
                    </div>
                </div>
                <div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">تاریخ شروع تعمیرات</label>
                        <div class="col-lg-8 col-xl-8">
                            <input name="settings[maintenance_start]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 " data-jdp placeholder="تاریخ شروع تعمیرات را وارد کنید" value="{{ $setting->settings['maintenance_start'] ?? '' }}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">تاریخ پایان تعمیرات</label>
                        <div class="col-lg-8 col-xl-8">
                            <input name="settings[maintenance_end]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 " data-jdp placeholder="تاریخ پایان تعمیرات را وارد کنید" value="{{ $setting->settings['maintenance_end'] ?? '' }}" />
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
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: { lat: 35.70222474889245, lng: 51.338657483464765 }
        });

        var marker = new google.maps.Marker({
            position: { lat: 35.70222474889245, lng: 51.338657483464765 },
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            document.getElementById('location-map').value = marker.getPosition().lat() + ',' + marker.getPosition().lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>
@endsection

@section("scripts")
<script>
    jalaliDatepicker.startWatch({
        time: true,
        hasSecond: false
    });
</script>
@endsection


