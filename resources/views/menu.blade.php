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
            <div class="col-lg-12 col-xl-12">
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
                                            <input type="hidden" name="child_menus[{{$index}}][id]" value="{{ $childMenu->id }}">
                                            <div class="accordion-body">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="child_menus[{{$index}}][title]">عنوان</label>
                                                    <input name="child_menus[{{$index}}][title]" type="text" class="form-control form-control-solid" value="{{ $childMenu->title }}" placeholder="عنوان را وارد کنید" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="child_menus[{{$index}}][link]">لینک</label>
                                                    <input name="child_menus[{{$index}}][link]" type="text" class="form-control form-control-solid" value="{{ $childMenu->link }}" placeholder="لینک را وارد کنید">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="child_menus[{{$index}}][alias]">نام مستعار</label>
                                                    <input name="child_menus[{{$index}}][alias]" type="text" class="form-control form-control-solid" value="{{ $childMenu->alias }}" placeholder="نام مستعار را وارد کنید" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="child_menus[{{$index}}][icon]">آیکون</label>
                                                    <input name="child_menus[{{$index}}][icon]" type="text" class="form-control form-control-solid" value="{{ $childMenu->icon }}" placeholder="آیکون را وارد کنید">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="child_menus[{{$index}}][show_title]">نمایش عنوان</label>
                                                    <select class="form-select form-select-solid" name="child_menus[{{$index}}][show_title]">
                                                        <option value="1" {{ $childMenu->show_title == 1 ? 'selected' : '' }}>بله</option>
                                                        <option value="0" {{ $childMenu->show_title == 0 ? 'selected' : '' }}>خیر</option>
                                                    </select>
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
        </div>
    @endif




    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection

@section('script-before')

@endsection
