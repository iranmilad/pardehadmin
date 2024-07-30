@extends('layouts.primary')

@section('title', 'پیامک')

@section('content')
    <form method="post" action="{{ route('services.update.sms') }}">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="form-group mb-5">
                    <label for="service" class="form-label">وبسرویس پیامک</label>
                    <div>
                        <select dir="ltr" data-control="select2" name="settings[service]" id="service" class="form-select">
                            <option value="1" {{ old('settings.service', $setting->settings['service']) == '1' ? 'selected' : '' }}>ippanel.com</option>
                            <option value="2" {{ old('settings.service', $setting->settings['service']) == '2' ? 'selected' : '' }}>yektatech.net</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="username" class="form-label">نام کاربری سرویس</label>
                    <div>
                        <input dir="ltr" type="text" class="form-control" name="settings[username]" id="username" value="{{ old('settings.username', $setting->settings['username']) }}">
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="password" class="form-label">کلمه عبور وبسرویس</label>
                    <div>
                        <input dir="ltr" type="text" class="form-control" name="settings[password]" id="password" value="{{ old('settings.password', $setting->settings['password']) }}">
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="sender_phone" class="form-label">شماره ارسال کننده پیامک</label>
                    <div>
                        <input dir="ltr" type="text" class="form-control" name="settings[sender_phone]" id="sender_phone" value="{{ old('settings.sender_phone', $setting->settings['sender_phone']) }}">
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="domain" class="form-label">دامنه سامانه پیامک</label>
                    <div>
                        <input type="url" class="form-control" name="settings[domain]" id="domain" value="{{ old('settings.domain', $setting->settings['domain']) }}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-10">ذخیره</button>
    </form>
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
