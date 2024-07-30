@extends('layouts.primary')

@section('title', isset($post) ? 'ویرایش پست' : 'ایجاد پست جدید')

@section('content')

<form method="post" action="{{ isset($post) ? route('post.update', $post) : route('post.store') }}" class="row post-type-row" enctype="multipart/form-data">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif

    <div class="col-lg-8 col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="mb-10">
                    <label for="title" class="required form-label">عنوان</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="عنوان را وارد کنید" value="{{ old('title', isset($post) ? $post->title : '') }}" />
                </div>
                <div class="mb-2">
                    <label class="form-label ">توضیحات</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <textarea id="editor" name="content" class="editor tw-max-h-96 tw-overflow-auto">{{ old('content', isset($post) ? $post->content : '') }}</textarea>
                        </div>
                    </div>
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
                <select class="form-select mb-2" name="published">
                    <option value="1" {{ old('published', isset($post) ? $post->published : 0) == 1 ? 'selected' : '' }}>فعال</option>
                    <option value="0" {{ old('published', isset($post) ? $post->published : 0) == 0 ? 'selected' : '' }}>غیرفعال</option>
                </select>
                <!--end::انتخاب2-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">وضعیت نوشته را تنظیم کنید.</div>
                <!--end::توضیحات-->
                <!--begin::انتخاب2-->
                <div class="form-check mt-5">
                    <input class="form-check-input" type="checkbox" value="1" name="comments_enabled" id="flexCheckChecked" {{ old('comments_enabled', isset($post) ? $post->comments_enabled : 1) == 1 ? 'checked' : '' }} />
                    <label class="form-check-label text-dark" for="flexCheckChecked">
                        فعال بودن دیدگاه ها
                    </label>
                </div>
                <!--end::انتخاب2-->
            </div>
            <!--end::کارت body-->
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!-- post id -->
                    <button type="submit" name="remove-post" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    <button class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->


        <!-- START:CATEGORY -->
        <div class="card card-flush py-4 mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h4>دسته بندی ها</h4>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="tw-max-h-56 tw-overflow-auto tw-pt-1">
                    <ul class="intermediat-checkbox category-list">
                        @foreach($categories as $category)
                            <li>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="{{ $category->id }}"
                                        id="category{{ $category->id }}"
                                        name="categories[]"
                                        {{ in_array($category->id, old('categories', isset($post) ? $post->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                                    />
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                                @if($category->children)
                                    <ul>
                                        @foreach($category->children as $child)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{ $child->id }}" id="category{{ $child->id }}" name="categories[]" {{ in_array($child->id, old('categories', isset($post) ? $post->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="category{{ $child->id }}">
                                                        {{ $child->name }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#add-fast-category">افزودن دسته ی جدید</button>
            </div>
        </div>
        <!-- END:CATEGORY -->

        <!-- START:TAGS -->
        <div class="card card-flush py-4 mb-5">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>برچسب ها</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body pt-0">
                <input
                    class="form-control form-control-solid"
                    name="tags"
                    value='{{ old("tags", isset($post) ? json_encode($post->tags->pluck("name")->toArray()) : "[]") }}'
                    id="post-type-tags"
                />

                @if(old('tags'))
                    @foreach(json_decode(old('tags'), true) as $tag)
                        <input type="hidden" name="tags[]" value="{{ $tag }}" />
                    @endforeach
                @endif

                <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
            </div>





            <!--end::کارت body-->
        </div>
        <!-- END:TAGS -->

        <!-- START: THUMBNAIL -->
        <div class="card card-flush py-4">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>تصویر شاخص</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body text-center pt-0">
                <!--begin::Image input-->
                <x-file-input type="single" :preview="true" name="thumbnail" :value="$post->image" />
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">تصویر شاخص را انتخاب کنید</div>
                <!--end::توضیحات-->
            </div>
            <!--end::کارت body-->
        </div>
        <!-- END:THUMBNAIL -->
    </div>
</form>
<x-add-fast-category />
@endsection

@section("script-before")

{{-- <script>
    CKEDITOR.replace( 'editor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
  </script>
<script>

    var input = document.querySelector("#post-type-tags");

    let post_types_tags = new Tagify(input, {
        dropdown: {
            enabled: 0,
            closeOnSelect: false,
            pattern: /^.{1,70}/,
        },
    });

    document.querySelector('form').addEventListener('submit', function (e) {
        // Get the tags as array of values
        let tags = post_types_tags.value.map(tag => tag.value);
        // Create hidden input with the JSON string of tags
        let hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'tags';
        hiddenInput.value = JSON.stringify(tags);
        this.appendChild(hiddenInput);
    });
</script> --}}


@endsection
