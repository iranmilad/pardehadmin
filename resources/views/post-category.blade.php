@extends('layouts.primary')

@section('title', Route::is('postCategories.edit') ? 'ویرایش دسته‌بندی' : 'ایجاد دسته‌بندی')

@section('content')
<div class="container">
    <form action="{{ Route::is('postCategories.edit') ? route('postCategories.update', $category->id) : route('postCategories.store') }}" method="POST">
        @csrf
        @if(Route::is('postCategories.edit'))
            @method('PUT')
        @endif
        <div class="card mb-8">
            <div class="card-header p-3">
                <h3>مشخصات دسته مادر</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">عنوان</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">نامک</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}" required>
                </div>
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-3">
                <h3>مشخصات دسته‌های فرزند</h3>
            </div>
            <div class="card-body">
                <div class="other_repeater">
                    <div data-repeater-list="children">
                        @if(isset($category) && $category->children->count())
                            @foreach($category->children as $child)
                                <div data-repeater-item>
                                    <div class="form-group row">
                                        <div class="col-12 col-md">
                                            <label for="child_name" class="form-label">عنوان</label>
                                            <input type="text" name="children[{{ $loop->index }}][name]" class="form-control" value="{{ old("children.{$loop->index}.name", $child->name) }}" required>
                                        </div>
                                        <div class="col-12 col-md">
                                            <label for="child_slug" class="form-label">نامک</label>
                                            <input type="text" name="children[{{ $loop->index }}][slug]" class="form-control" value="{{ old("children.{$loop->index}.slug", $child->slug) }}" required>
                                        </div>
                                        <div class="col-12 col-md">

                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-10">حذف</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label for="child_name" class="form-label">عنوان</label>
                                        <input type="text" name="children[0][name]" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="child_slug" class="form-label">نامک</label>
                                        <input type="text" name="children[0][slug]" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-md">

                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-10">حذف</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <a href="javascript:;" data-repeater-create class="btn btn-sm btn-primary">افزودن</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.other_repeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    });
</script>
@endsection
