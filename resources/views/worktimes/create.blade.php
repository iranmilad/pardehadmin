@extends('layouts.primary')

@section('title', 'ایجاد زمان کاری')

@section('content')
<form action="{{ route('worktimes.store') }}" method="post">
    @csrf
    <div class="card mb-10">
        <div class="card-header">
            <div class="card-title">
                <h4>زمان های انجام کار</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label class="form-label required">کاربر :</label>
                    <select name="user_id" class="form-control">
                        @foreach($users as $user)
                            @if ($user->role->title != "user")
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label required">تاریخ :</label>
                    <input name="date" type="text" class="form-control mb-2 mb-md-0 time_picker" placeholder="تاریخ را وارد کنید" />
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label required">زمان مورد نیاز :</label>
                    <div class="input-group">
                        <input dir="ltr" name="hours" type="number" min="1" max="24" class="form-control mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" />
                        <span class="input-group-text">ساعت</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success">ذخیره</button>
</form>
@endsection

@section('script-before')
<script src="{{ asset('plugins/flatpicker_fa.js') }}"></script>
<script src="{{ asset('plugins/jdate.min.js') }}"></script>
@endsection

@section('scripts')
<script>
    window.Date = window.JDate;
    $(".time_picker").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
        mode: "range"
    });
</script>
@endsection
