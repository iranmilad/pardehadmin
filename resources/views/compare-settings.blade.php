@extends('layouts.primary')

@section('title', 'تنظیمات مقایسه محصولات')


@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="form-group row mb-10">
                <label class="col-12 col-lg-2 form-label fw-bold">غیر فعال برای کاربران احراز هویت نشده</label>
                <div class="col-12 col-lg-8">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    </div>

                </div>
            </div>

            <div class="form-group row mb-10">
                <label class="col-12 col-lg-2 form-label fw-bold">تعداد محصولات برای مقایسه:</label>
                <div class="col-12 col-lg-8">
                    <input class="form-control form-control-solid" type="number" placeholder="تعداد را وارد کنید" />
                </div>
            </div>

            <div class="form-group row mb-10">
                <label for="new_price" class="col-12 col-lg-2 form-label fw-bold">دسته بندی ها:</label>
                <div class="col-12 col-lg-8">
                    <x-advanced-search type="category" label="" name="category" solid />
                </div>
            </div>

            <div class="form-group row mb-10">
                <label for="new_price" class="col-12 col-lg-2 form-label fw-bold">جدول مقایسه:</label>
                <div class="col-12 col-lg-8">
                    <div class="mb-5 d-flex tw-gap-5">
                        <select class="form-select form-select-solid" id="compare-settings-fields-controller">
                            <option value="thumbnail" selected>تصویر</option>
                            <option value="sku">شناسه محصول</option>
                            <option value="rating">امتیاز</option>
                            <option value="price">قیمت</option>
                            <option value="availibity">موجودی</option>
                            <option value="features">ویژگی ها</option>
                        </select>
                        <button type="button" class="btn btn-success">افزودن</button>
                    </div>
                    <div id="compare-settings-fields" class="d-flex tw-flex-col tw-gap-y-2 tw-border-2 tw-border-slate-200 tw-border-dashed p-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection


@section('script')
<script>

</script>
@endsection