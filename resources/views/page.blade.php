@extends('layouts.primary')

@section('title', Route::is('pages.edit') ? 'ویرایش صفحه' : 'ایجاد صفحه')

@section('content')

<form method="post" action="{{ Route::is('pages.edit') ? route('pages.update', $page->id) : route('pages.store') }}" class="row post-type-row">
    @csrf
    @if(Route::is('pages.edit'))
        @method('PUT')
    @endif
    <div class="col-lg-8 col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="mb-10">
                    <label for="title" class="required form-label">عنوان</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="عنوان را وارد کنید" value="{{ old('title', $page->title ?? '') }}" />
                    @if(isset($page))
                        <a class="text-primary nav-link tw-w-max mt-1" href="#link_edit" data-bs-toggle="collapse">آدرس لینک</a>
                    @endif
                </div>
                <div class="collapse" id="link_edit">
                    <div>
                        <label for="slug">آدرس صفحه</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="آدرس صفحه را وارد کنید" value="{{ old('slug', $page->slug ?? '') }}" oninput="this.value = this.value.replace(/\s+/g, '-')" />
                    </div>
                </div>
                <div class="mb-2 mt-10">
                    <label class="form-label">محتوای صفحه</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <textarea id="content" name="content" class="editor tw-max-h-96 tw-overflow-auto">{{ old('content', isset($page) ? $page->content : '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">خلاصه</label>
                    <textarea name="summary" class="form-control">{{ old('summary', $page->summary ?? '') }}</textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">کلمات کلیدی</label>
                    <input type="text" name="keywords" class="form-control" value="{{ old('keywords', $page->keywords ?? '') }}" />
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-2 mt-5 mt-lg-0">
        <!-- START:STATUS -->
        <div class="card card-flush py-4 mb-5">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>وضعیت</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body pt-0">
                <!--begin::انتخاب2-->
                <select name="status" class="form-select mb-2">
                    <option value="published" {{ old('status', $page->status ?? '') == 'published' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ old('status', $page->status ?? '') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                </select>
                <!--end::انتخاب2-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">وضعیت نوشته را تنظیم کنید.</div>
                <!--end::توضیحات-->
            </div>
            <!--end::کارت body-->
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!-- post id -->
                    @if(Route::is('pages.edit'))
                        <a type="button" name="remove-post" value="1" class="btn btn-sm btn-danger" id="remove-button" href="{{ route('pages.delete',$page->id)}}" >حذف</a>
                    @endif
                    <button type="submit" class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->
    </div>
</form>
<x-add-fast-category />
<x-short-code-editor />
@endsection

