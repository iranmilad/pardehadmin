<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ویرایش برچسب')

@section('content')

<!-- PARENT -->
<div class="card mb-8">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات برچسب</h3>
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
                </div>
                <button class="btn btn-success" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
</div>
<!-- PARENT -->

@endsection;