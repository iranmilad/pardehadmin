@extends('layouts.primary')

@section('title', 'ویرایش منو')

@section('content')
<form action="{{ route('menus.update', $menu->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>ویرایش منو</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="menu_id">انتخاب منو مادر</label>
                    <select class="form-select form-select-solid" name="menu_id" id="menu_id">
                        <option value="">بدون والد</option>
                        @foreach($parentMenus as $parentMenu)
                            <option value="{{ $parentMenu->id }}" {{ $menu->menu_id == $parentMenu->id ? 'selected' : '' }}>{{ $parentMenu->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="title">عنوان</label>
                    <input name="title" type="text" class="form-control form-control-solid" value="{{ $menu->title }}" placeholder="عنوان را وارد کنید" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="link">لینک</label>
                    <input name="link" type="text" class="form-control form-control-solid" value="{{ $menu->link }}" placeholder="لینک را وارد کنید">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="alias">نام مستعار</label>
                    <input name="alias" type="text" class="form-control form-control-solid" value="{{ $menu->alias }}" placeholder="نام مستعار را وارد کنید" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="icon">آیکون</label>
                    <input name="icon" type="text" class="form-control form-control-solid" value="{{ $menu->icon }}" placeholder="آیکون را وارد کنید">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="show_title">نمایش عنوان</label>
                    <select class="form-select form-select-solid" name="show_title" id="show_title">
                        <option value="1" {{ $menu->show_title == 1 ? 'selected' : '' }}>بله</option>
                        <option value="0" {{ $menu->show_title == 0 ? 'selected' : '' }}>خیر</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    @if(isset($childMenus) && $childMenus->count() > 0)
        <div class="row mt-10">
            <div class="col-lg-3 col-xl-2">
                <!--begin::Accordion-->
                <div class="accordion" id="kt_accordion_1">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="kt_accordion_1_header_1">
                            <button class="accordion-button fs-6 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="false" aria-controls="kt_accordion_1_body_1">
                                دسته ها
                            </button>
                        </h2>
                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                            <div class="accordion-body">
                                <div class="tw-min-h-40 tw-max-h-72 tw-overflow-y-auto tw-py-1">
                                    @foreach($categories as $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="flexCheckDefault{{$category->id}}" data-link="{{$category->link}}" data-title="{{$category->title}}" />
                                            <label class="form-check-label" for="flexCheckDefault{{$category->id}}">
                                                {{$category->title}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-primary other_items_menu">افزودن</button>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="kt_accordion_1_header_11">
                            <button class="accordion-button fs-6 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                آدرس سفارشی
                            </button>
                        </h2>
                        <div id="kt_accordion_1_body_2" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                            <div class="accordion-body">
                                <div class="mb-5">
                                    <label for="" class="form-label">عنوان</label>
                                    <input type="text" class="form-control custom-link-title">
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label">لینک</label>
                                    <input type="text" class="form-control custom-link-link" placeholder="https://example.com">
                                </div>
                                <button class="btn btn-sm btn-primary custom-link-gen" type="button">افزودن</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Accordion-->
            </div>
            <div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-body">
                        <div id="menu_lists" class="primary-list">
                            @foreach($childMenus as $index => $childMenu)
                                <div>
                                    <div class="accordion" id="accordionExample{{$index}}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$index}}" aria-expanded="false" aria-controls="collapseOne{{$index}}">
                                                    {{$childMenu->title}}
                                                </button>
                                            </h2>
                                            <div id="collapseOne{{$index}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample{{$index}}">
                                                <div class="accordion-body">
                                                    <div class="mb-5">
                                                        <label for="" class="form-label">عنوان</label>
                                                        <input type="text" class="form-control"  value="{{ $childMenu->title }}" placeholder="عنوان را وارد کنید">
                                                    </div>
                                                    <div class="mb-5">
                                                        <label for="" class="form-label">لینک</label>
                                                        <input type="link" class="form-control" value="{{ $childMenu->link }}" placeholder="https://example.com">
                                                    </div>
                                                    <div class="mb-5">
                                                        <label for="" class="form-label">آیکون</label>
                                                        <input type="file" class="form-control" value="{{ $childMenu->icon }}" placeholder="آیکون را وارد کنید">
                                                    </div>
                                                    <button class="btn btn-sm btn-danger remove-accordion">حذف</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection

@section('script-before')

@endsection
