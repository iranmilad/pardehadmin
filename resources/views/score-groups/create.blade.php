@extends('layouts.primary')

@if(Route::is('score-groups.edit'))
    @section('title', 'ویرایش شرایط گروه')
@else
    @section('title', 'ایجاد شرایط گروه')
@endif

@section('content')
<form action="{{ Route::is('score-groups.edit') ? route('score-groups.update', $creditLimit->id) : route('score-groups.store') }}" method="POST">
    @csrf
    @if(Route::is('score-groups.edit'))
        @method('PUT')
    @endif

    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5">
                <label for="group" class="col-2 form-label">انتخاب گروه</label>
                <div class="col-10">
                    <x-advanced-search type="group" label="" name="group" solid :value="old('group', $creditLimit->group_id ?? '')" />
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label">عنوان</label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="text" name="title" class="form-control form-control-solid" value="{{ old('title', $creditLimit->title ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="min_score" class="col-2 form-label">حداقل نمره لازم برای ورود به گروه</label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" name="min_score" class="form-control form-control-solid" value="{{ old('min_score', $creditLimit->min_score ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="max_score" class="col-2 form-label">حداکثر نمره لازم برای ورود به گروه</label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" name="max_score" class="form-control form-control-solid" value="{{ old('max_score', $creditLimit->max_score ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection
