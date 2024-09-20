@extends('layouts.primary')

@section('title', 'ایجاد بنر')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('banners.store') }}">
            @csrf
            <div class="form-group row mt-5 mb-5">
                <div class="col-12 col-md-6">
                    <input name="widget_id" type="hidden" value="{{ $widget->id }}"/>
                    <input name="type" type="hidden" value="selection"/>
                    <div class="mt-5 mb-5">
                        <label class="form-label">عنوان بنر:</label>
                        <input name="name" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان بنر را وارد کنید" />
                    </div>
                    <div class="mt-5 mb-5">
                        <label class="form-label">استایل:</label>
                        <select class="form-select form-select-solid tw-w-max" name="type" id="type">
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!--begin::Form group-->
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">ایجاد </button>
            </div>
            <!--end::Form group-->
        </form>
    </div>
</div>
@endsection
