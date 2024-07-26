@extends('layouts.primary')

@if(Route::is('users.roles.create'))
@section('title', 'ایجاد نقش')
@else
@section('title', 'ویرایش نقش')
@endif


@section('content')

<form action="">
    @csrf
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">اطلاعات نقش</h4>
                </div>
                <div class="card-body">
                    <div class="form-group col-6">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" id="title" name="title" class="form-control" value="">
                    </div>

                    <div class="form-group col-6 mt-2">
                        <label for="display_name" class="required form-label">نام نمایشی</label>
                        <input name="display_name" id="display_name" class="form-control" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-1">

        <div class="col">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">دسترسی ها</h4>
                </div>


                <div class="card-body">


                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر نوشته</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر نوشته های دیگران</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">حذف نوشته ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">انتشار نوشته ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش نوشته های منتشر شده</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر برگه</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر برگه های دیگران</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">حذف برگه ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">انتشار برگه ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش برگه های منتشر شده</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر محصولات</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر محصولات دیگران</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">حذف محصولات</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">انتشار محصولات</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش محصولات منتشر شده</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش ویژگی ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش دسته بندی ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش دیدگاه ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش پیکربندی ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">افزودن تخفیف</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایشگر تخفیف های دیگران</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">حذف تخفیف ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">انتشار تخفیف ها</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                        <div class="col">
                            <label for="" class="form-label">ویرایش تخفیف های منتشر شده</label>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                                <div class="col-1 form-check">
                                    <input class="form-check-input" style="float: none;" type="checkbox" value="" id="flexCheckDefault">
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
