@extends('layouts.primary')

@section('title', 'دیدگاه')

@section('content')

<form method="post" action="{{ isset($review) ? route('products.reviews.update', $review->id) : route('products.reviews.store') }}" class="row post-type-row" enctype="multipart/form-data">
    @csrf
    @if(isset($review))
        @method('PUT')
    @endif
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <div class="col-lg-8 col-xl-9">
        <div class="card mb-5">
            <div class="card-body">
                <h4>محصول : </h4>
                <a class="text-decoration-underline" name="title" href="{{ route('products.index', $product->id) }}">{{ $product->title }}</a>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-body">
                <div>
                    <label class="form-label">عنوان دیدگاه</label>
                    <input type="text" class="form-control"  placeholder="عنوان دیدگاه را وارد کنید" name="title" id="title" value="{{ old('title', $review->title ?? '') }}">
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-body">
                <div>
                    <label class="form-label">متن دیدگاه</label>
                    <textarea class="form-control" rows="10" placeholder="متن دیدگاه را وارد کنید" name="text" id="text">{{ old('text', $review->text ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-body">
                <div>
                    <h4>امتیاز دهی کاربر</h4>
                </div>
                <div class="row mt-7">
                    <div class="row mt-1">
                        <div class="col-2">
                            <label for="quality" class="form-label">کیفیت</label>
                        </div>
                        <div class="col-2">
                            <input type="number" name="quality" class="form-control text-center" min="0" max="5" value="{{ old('quality', $review->quality ?? 0) }}">
                        </div>
                    </div>
                    <div class="row mt-1">
                    <div class="col-2">
                        <label for="performance" class="form-label">عملکرد</label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="performance" class="form-control text-center" min="0" max="5" value="{{ old('performance', $review->performance ?? 0) }}">
                    </div>
                    </div>

                    <div class="row mt-1">
                    <div class="col-2">
                        <label for="design" class="form-label">طراحی</label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="design" class="form-control text-center" min="0" max="5" value="{{ old('design', $review->design ?? 0) }}">
                    </div>
                    </div>

                    <div class="row mt-1">
                    <div class="col-2">
                        <label for="price" class="form-label">قیمت</label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="price" class="form-control text-center" min="0" max="5" value="{{ old('price', $review->price ?? 0) }}">
                    </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-2">
                            <label for="ease_of_use" class="form-label">سهولت استفاده</label>
                        </div>
                        <div class="col-2">
                            <input type="number" name="ease_of_use" class="form-control text-center" min="0" max="5" value="{{ old('ease_of_use', $review->ease_of_use ?? 0) }}">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="rating" class="form-label">امتیاز کل</label>
                        </div>
                        <div class="col-2">
                            <input type="number" name="rating" class="form-control text-center" min="0" max="5" value="{{ old('rating', $review->rating ?? 0) }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>تصاویر بارگزاری شده</h4>
                <div class="row myt-7">
                    @foreach(old('images', json_decode($review->images,true) ?? []) as $index => $image)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="image-input image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ $image }}')"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
                                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="file" name="images[{{ $index }}]" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="existing_images[]" value="{{ $image }}" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
                                <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                <input type="file" name="images[]" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="new_images[]" />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-xl-3 mt-5 mt-lg-0">
        <div class="card card-flush py-4 mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h4>وضعیت</h4>
                </div>
            </div>
            <div class="card-body pt-0">
                <select class="form-select mb-2" name="status">
                    <option value="pending" {{ old('status', $review->status ?? '') == 'pending' ? 'selected' : '' }}>در انتظار</option>
                    <option value="rejected" {{ old('status', $review->status ?? '') == 'rejected' ? 'selected' : '' }}>رد شده</option>
                    <option value="approved" {{ old('status', $review->status ?? '') == 'approved' ? 'selected' : '' }}>تایید شده</option>
                </select>
                <div class="text-muted fs-7">وضعیت دیدگاه را تنظیم کنید.</div>
                <div class="w-100 mt-5">
                    <span class="text-muted"> تاریخ ثبت دیدگاه : <b class="text-dark">{{ $review->dateShamsi ?? now() }}<span></span></b></span>
                </div>
                @if(isset($review->user))
                <div class="mt-5">
                    <a href="#" class="d-flex align-items-center flex-row">
                        <div class="symbol symbol-40px me-3">
                            <img src="{{ $review->user->avatar ?? '/images/avatar.png' }}" class="" alt="" />
                        </div>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $review->user->first_name.' '.$review->user->last_name }}</span>
                            <span class="text-primary">مشاهده کاربر</span>
                        </div>
                    </a>
                </div>
                @endif
            </div>
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    @if(isset($review))
                        <button type="submit" name="remove-comment" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    @endif
                    <button type="submit" class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
