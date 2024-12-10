@extends('layouts.primary')

@section('title', isset($tag) ? 'ویرایش برچسب' : 'ایجاد برچسب')

@section('content')
<div class="card mb-8">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>مشخصات برچسب</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ isset($tag) ? route('products.tags.update', $tag->id) : route('products.tags.store') }}" method="post">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="name" class="form-label required">عنوان</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="عنوان را وارد کنید" value="{{ old('name', $tag->name ?? '') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="slug" class="form-label required">نامک</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="نامک را وارد کنید" value="{{ old('slug', $tag->slug ?? '') }}" oninput="this.value = this.value.replace(/\s+/g, '-')">
                        </div>
                    </div>

                    <div class="col-12 col-md">
                        <div class="mb-3">


                            <label for="type" class="form-label required">گروه برچسب</label>
                            <select class="form-select mb-2" id="type" name="type" placeholder="گروه برچسب را وارد کنید">
                                <option value="blog" {{ old('type', isset($tag) ? $tag->type : 0) == "blog" ? 'selected' : '' }}>بلاگ</option>
                                <option value="ability" {{ old('type', isset($tag) ? $tag->type : 0) == "ability" ? 'selected' : '' }}>عملکرد محصول</option>
                                <option value="function" {{ old('type', isset($tag) ? $tag->type : 0) == "function" ? 'selected' : '' }}>کاربری محصول</option>
                                <option value="future" {{ old('type', isset($tag) ? $tag->type : 0) == "future" ? 'selected' : '' }}>ویژگی محصول</option>
                            </select>
                            {{-- <input type="text" class="form-control" id="type" name="type"  value="{{ old('type', $tag->type ?? '') }}"> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md">
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="توضیحات را وارد کنید" value="{{ old('description', $tag->description ?? '') }}">
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit">{{ isset($tag) ? 'ذخیره تغییرات' : 'ایجاد برچسب' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
