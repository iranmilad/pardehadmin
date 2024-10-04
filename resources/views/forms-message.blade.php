<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'پیام')

@section('content')

<form method="post" class="row post-type-row">
    @csrf
    <div class="col-lg-8 col-xl-9">
        <div class="card mb-5">
            <div class="card-body">
                <div class="row gy-5">
                    <div class="col-12 labely">
                        <b>نام: </b>
                        <label for="">فرهاد</label>
                    </div>
                    <div class="col-12 labely">
                        <b>نام خانوادگی: </b>
                        <label for="">باقری</label>
                    </div>
                    <div class="col-12 labely">
                        <b>جنسیت: </b>
                        <label for="">اقا</label>
                    </div>
                    <div class="col-12 labely">
                        <b>پیام: </b>
                        <label for="">متن تست جهت نمایش</label>
                    </div>
                    <div class="col-12 labely">
                        <b>تصاویر: </b>
                        <nav>
                            <a href="https://placehold.co/400">تصویر 1</a>
                            |
                            <a href="https://placehold.co/400">تصویر 1</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-3 mt-5 mt-lg-0">
        <!-- START:STATUS -->
        <div class="card card-flush py-4 mb-5">
            <div class="card-body">
                <h4>فرم : </h4>
                <a class="text-decoration-underline" href="{{route('form.edit.show',['id' => 1])}}">تماس باما</a>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!-- post id -->
                    <button type="submit" name="remove-comment" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    <button class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->

    </div>
</form>

@endsection