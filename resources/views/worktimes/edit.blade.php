@extends('layouts.primary')

@if(Route::is('worktimes.edit'))
    @section('title', 'ویرایش زمان کاری')
@else
    @section('title', 'ایجاد زمان کاری')
@endif

@section('content')

<form action="{{ Route::is('worktimes.edit') ? route('worktimes.update', $user->id) : route('worktimes.store') }}" method="post">
    @csrf
    @if(Route::is('worktimes.edit'))
        @method('PUT')
    @endif

    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>زمان های انجام کار</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        @php
                            $selectedUser = [["id"=>$user->id,"text"=>$user->full_name]];
                        @endphp
                        <x-advanced-search type="user" label="کاربر" name="user_id" :selected="$selectedUser" disabled/>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label required">تاریخ :</label>
                        <input name="date" type="text" class="form-control mb-2 mb-md-0 time_picker" placeholder="تاریخ را وارد کنید" value="{{ old('date') }}" />
                        @if ($errors->has('date'))
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label required">زمان مورد نیاز :</label>
                        <div class="input-group">
                            <input dir="ltr" name="hours" type="number" min="1" max="24" class="form-control mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" value="{{ old('hours') }}" />
                            <span class="input-group-text">ساعت</span>
                        </div>
                        @if ($errors->has('hours'))
                            <span class="text-danger">{{ $errors->first('hours') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-10">
        <div class="card-header">
            <h4 class="card-title">خلاصه زمان های کاربر</h4>
        </div>
        <div class="card-body">
            <table id="global_table" class="table table-striped gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="cursor-pointer text-start">روز</th>
                        <th class="cursor-pointer text-start">زمان</th>
                        <th class="cursor-pointer text-start">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->worktimes as $time)
                        <tr>
                            <td>
                                <span class="text-primary tw-font-medium">{{ $time->dateShamsi }}</span>
                            </td>
                            <td>
                                <span class="text-primary tw-font-medium">{{ $time->hours }} ساعت</span>
                            </td>
                            <td>
                                <form action="{{ route('worktimes.destroy', $time->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <button class="btn btn-success">ذخیره</button>
</form>

@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('plugins/flatpicker_fa.js') }}"></script>
<script src="{{ asset('plugins/jdate.min.js') }}"></script>
@endsection

@section("scripts")
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
