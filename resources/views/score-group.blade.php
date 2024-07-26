@extends('layouts.primary')

@if(Route::is('score-group.edit.show'))
    @section('title', 'ویرایش شرایط گروه')
@else
    @section('title', 'ایجاد شرایط گروه')
@endif

@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="form-group row mb-5">
                <label for="group" class="col-2 form-label">انتخاب گروه</label>
                <div class="col-10">
                    <x-advanced-search type="group" label="" name="group" solid />
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label"> عنوان  : </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="text" name="title" class="form-control form-control-solid">
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">حداقل نمره لازم برای ورود به گروه : </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" class="form-control form-control-solid">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">حداکثر نمره لازم برای ورود به گروه </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" class="form-control form-control-solid">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection
