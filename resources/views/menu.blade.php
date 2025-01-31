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
                            <option value="{{ $parentMenu->id }}" {{ $menu->menu_id == $parentMenu->id ? 'selected' : '' }}>
                                {{ $parentMenu->hierarchical_title }}
                            </option>
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
                    <label class="form-label" for="type">نوع نمایش</label>
                    <select class="form-select form-select-solid" name="type" id="type">
                        <option value="menu_category" {{ $menu->type == "menu_category" ? 'selected' : '' }}>ساده</option>
                        <option value="portfolio" {{ $menu->type == "portfolio" ? 'selected' : '' }}>سبد</option>
                        <option value="features_menu" {{ $menu->type == "features_menu" ? 'selected' : '' }}>ویژگی</option>
                    </select>
                </div>


                <div class="col-md-6">
                    <label class="form-label" for="icon">آیکون</label>
                    <x-file-input type="single" :preview="false" name="icon" :value="$menu->icon" />

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
                                            <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="flexCheckDefault{{$category->id}}" data-link="{{$category->link}}" data-title="{{$category->title}}" data-alias="{{$category->alias}}" />
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

            </div>
            <!--end::Accordion-->
            @if(isset($childMenus) && $childMenus->count() > 0)
                <div class="col-lg-9 col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            <div id="menu_lists" class="primary-list">
                                @foreach ($childMenus as $menu)
                                    <div>
                                        <div class="accordion" id="accordionExample{{1000+$menu->id}}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{1000+$menu->id}}" aria-expanded="false" aria-controls="collapseOne{{1000+$menu->id}}">
                                                        {{$menu->title}}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne{{1000+$menu->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample{{1000+$menu->id}}">
                                                    <div class="accordion-body">
                                                        <input type="hidden" name="menu[{{1000+$menu->id}}][id]"  value="{{$menu->id}}">
                                                        <div class="mb-5">
                                                            <label for="" class="form-label">عنوان</label>
                                                            <input name="menu[{{1000+$menu->id}}][title]" type="text" class="form-control" value="{{$menu->title}}">
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="" class="form-label">لینک</label>
                                                            <input name="menu[{{1000+$menu->id}}][link]" type="link" class="form-control" placeholder="https://example.com"  value="{{$menu->link}}">
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="" class="form-label">نام مستعار</label>
                                                            <input name="menu[{{1000+$menu->id}}][alias]" type="text" class="form-control" placeholder="" value="{{$menu->alias}}">
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="" class="form-label">آیکون</label>
                                                            <x-file-input type="single" :preview="false" name="menu[{{1000+$menu->id}}][icon]" :value="$menu->icon" editabl/>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="" class="form-label">نمایش عنوان</label>
                                                            <select name="menu[{{1000+$menu->id}}][show_title]" id="" class="form-select">
                                                                <option value="1" {{ $menu->show_title==true ? 'selected' : ''}}>بله</option>
                                                                <option value="0" {{ $menu->show_title==false ? 'selected' : ''}}>خیر</option>
                                                            </select>
                                                        </div>
                                                        <div class="content-between d-flex justify-content-between">
                                                            @if (count($menu->childMenus)>0)
                                                                <a href="{{ route('menus.edit', ['id' => $menu->id]) }}" class="btn btn-sm btn-success">زیر منو</a>
                                                            @endif
                                                            <button class="btn btn-sm btn-danger remove-accordion">حذف</button>
                                                        </div>
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
            @endif
        </div>


    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection

@section('script-before')

@endsection
