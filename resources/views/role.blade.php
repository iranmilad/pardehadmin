@extends('layouts.primary')

@if(Route::is('user.role.create.show'))
@section('title', 'ایجاد نقش')
@else
@section('title', 'ویرایش نقش')
@endif


@section('content')

<form action="">
    @csrf
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills me-3 tw-gap-y-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link tw-w-max tw-mx-auto tw-text-right active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#nav-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">نوشته ها</button>
                        <button class="nav-link tw-w-max tw-mx-auto tw-text-right" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">برگه ها</button>
                        <button class="nav-link tw-w-max tw-mx-auto tw-text-right" id="v-pills-product-tab" data-bs-toggle="pill" data-bs-target="#nav-product" type="button" role="tab" aria-controls="v-pills-product" aria-selected="false">محصولات</button>
                        <button class="nav-link tw-w-max tw-mx-auto tw-text-right" id="v-pills-discounts-tab" data-bs-toggle="pill" data-bs-target="#nav-discounts" type="button" role="tab" aria-controls="v-pills-discounts" aria-selected="false">تخفیف ها</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex tw-w-full tw-items-center tw-justify-between mb-4">
                                <span class="text-muted fs-6">عملیات ها</span>
                                <div class="form-check">
                                    <input class="form-check-input" style="float: none;margin-right: unset;" type="checkbox" value="" id="flexCheckDefault" data-kt-check="true" data-kt-check-target="#nav-home .row .form-check-input">
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر نوشته</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر نوشته های دیگران</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">حذف نوشته ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">انتشار نوشته ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش نوشته های منتشر شده</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex tw-w-full tw-items-center tw-justify-between mb-4">
                                <span class="text-muted fs-6">عملیات ها</span>
                                <div class="form-check">
                                    <input class="form-check-input" style="float: none;margin-right: unset;" type="checkbox" value="" id="flexCheckDefault" data-kt-check="true" data-kt-check-target="#nav-profile .row .form-check-input">
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر برگه</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر برگه های دیگران</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">حذف برگه ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">انتشار برگه ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش برگه های منتشر شده</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab" tabindex="0">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex tw-w-full tw-items-center tw-justify-between mb-4">
                                <span class="text-muted fs-6">عملیات ها</span>
                                <div class="form-check">
                                    <input class="form-check-input" style="float: none;margin-right: unset;" type="checkbox" value="" id="flexCheckDefault" data-kt-check="true" data-kt-check-target="#nav-product .row .form-check-input">
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر محصولات</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر محصولات دیگران</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">حذف محصولات</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">انتشار محصولات</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش محصولات منتشر شده</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش ویژگی ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش دسته بندی ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش دیدگاه ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش پیکربندی ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-discounts" role="tabpanel" aria-labelledby="nav-discounts-tab" tabindex="0">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex tw-w-full tw-items-center tw-justify-between mb-4">
                                <span class="text-muted fs-6">عملیات ها</span>
                                <div class="form-check">
                                    <input class="form-check-input" style="float: none;margin-right: unset;" type="checkbox" value="" id="flexCheckDefault" data-kt-check="true" data-kt-check-target="#nav-discounts .row .form-check-input">
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">افزودن تخفیف</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایشگر تخفیف های دیگران</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">حذف تخفیف ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">انتشار تخفیف ها</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                                <div class="col">
                                    <label for="" class="form-label">ویرایش تخفیف های منتشر شده</label>
                                </div>
                                <div class="col tw-text-left">
                                    <div class="form-check">
                                        <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10">ذخیره</button>
</form>

@endsection