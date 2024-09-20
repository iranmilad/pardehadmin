@extends('layouts.primary')

@section('title', isset($category) ? 'ویرایش دسته بندی' : 'ایجاد دسته بندی')

@section('content')
<div class="card mb-8">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>{{ isset($category) ? 'ویرایش دسته بندی' : 'ایجاد دسته بندی' }}</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label required">عنوان</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="عنوان را وارد کنید" value="{{ old('title', $category->title ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="alias" class="form-label required">نامک</label>
                                <input type="text" class="form-control" id="alias" name="alias" placeholder="نامک را وارد کنید" value="{{ old('alias', $category->alias ?? '') }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">دسته والد</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">بدون دسته والد</option>
                                    @foreach($categories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}" {{ (old('parent_id') ?? $category->parent_id ?? '') == $parentCategory->id ? 'selected' : '' }}>
                                            {{ $parentCategory->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">توضیحات</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="توضیحات این دسته را وارد کنید" value="{{ old('description', $category->description ?? '') }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="img" class="form-label">تصویر</label>
                                <x-file-input type="single" :preview="false" name="img" id="img" :value="$category->img" />

                            </div>
                        </div>

                    </div>


                    <button class="btn btn-success" type="submit">{{ isset($category) ? 'ذخیره تغییرات' : 'ایجاد دسته بندی' }}</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- CHILDREN -->
@if(isset($category) && $category->subcategories->count() > 0)
    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>دسته های فرزند</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>نامک</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->subcategories as $subCategory)
                            <tr>
                                <td>{{ $subCategory->title }}</td>
                                <td>{{ $subCategory->alias }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $subCategory->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
<!-- CHILDREN -->
@endsection
