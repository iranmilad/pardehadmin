@extends('layouts.primary')

@section('title', 'ویرایش برچسب')

@section('content')
<div class="container">

    <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('post.store') }}" method="POST">
        @csrf
        @if(isset($tag))
            @method('PUT')
        @endif

        <div class="card mb-8">
            <div class="card-header m-10">
                <h3>مشخصات برچسب</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="name" class="form-label required">عنوان</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tag->name ?? '') }}" placeholder="عنوان را وارد کنید" required>
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="slug" class="form-label required">نامک</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $tag->slug ?? '') }}" placeholder="نامک را وارد کنید" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>
        </div>
    </form>
</div>
@endsection
