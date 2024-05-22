@extends('layouts.primary')

@section('title', isset($comment) ? 'ویرایش دیدگاه' : 'ایجاد دیدگاه')

@section('content')

<form method="post" action="{{ isset($comment) ? route('comments.update', $comment->id) : route('comments.store') }}" class="row post-type-row">
    @csrf
    @if(isset($comment))
        @method('PUT')
    @endif
    <div class="col-lg-8 col-xl-9">
        <div class="card mb-5">
            <div class="card-body">
                <h4>نوشته : </h4>
                <a class="text-decoration-underline" href="{{ route('post.edit', $comment->post_id ?? $post->id) }}">{{ $comment->post->title ?? $post->title }}</a>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-body">
                <div>
                    <label class="form-label">متن دیدگاه</label>
                    <textarea class="form-control" rows="10" placeholder="متن دیدگاه را وارد کنید" name="content">{{ $comment->text ?? old('content') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-3 mt-5 mt-lg-0">
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
                <select class="form-select mb-2" name="status">
                    <option value="pending" {{ isset($comment) && $comment->status == 'pending' ? 'selected' : '' }}>در انتظار</option>
                    <option value="approved" {{ isset($comment) && $comment->status == 'approved' ? 'selected' : '' }}>تایید شده</option>
                    <option value="rejected" {{ isset($comment) && $comment->status == 'rejected' ? 'selected' : '' }}>رد شده</option>
                </select>
                <!--end::انتخاب2-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">وضعیت دیدگاه را تنظیم کنید.</div>
                <!--end::توضیحات-->
                <!--end::انتخاب2-->
                @if(isset($comment))
                <div class="w-100 mt-5">
                    <span class="text-muted"> تاریخ ثبت دیدگاه : <b class="text-dark">{{ $comment->dateShamsi }}</b></span>
                </div>

                <div class="mt-5">
                    <a href="#" class="d-flex align-items-center flex-row">
                        <div class="symbol symbol-40px me-3">
                            <img src="/images/avatar.png" class="" alt="" />
                        </div>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $comment->name }}</span>
                            <span class="text-primary">مشاهده کاربر</span>
                        </div>
                    </a>
                </div>
                @endif
            </div>
            <!--end::کارت body-->
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    @if(isset($comment))
                    <button type="submit" name="remove-comment" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    @endif
                    <button class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->
    </div>
</form>

@endsection
