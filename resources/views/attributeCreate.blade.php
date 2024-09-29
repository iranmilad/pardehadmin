@extends('layouts.primary')

@section('title', 'ایجاد و ویرایش ویژگی')


@section('toolbar')
@if(isset($attribute))
    <a href="{{ route('attribute.properties.create', $attribute->id) }}" class="btn btn-primary">خصوصیت جدید</a>
@endif
@endsection

@section('content')
<form method="post" action="{{ isset($attribute) ? route('attributes.update', $attribute->id) : route('attributes.store') }}">
    @csrf
    @if(isset($attribute))
        @method('PUT')
    @endif

    <!-- PARENT -->
    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>{{ isset($attribute) ? 'ویرایش ویژگی' : 'تعریف ویژگی مادر' }}</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label required">عنوان</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="عنوان ویژگی را وارد کنید" required value="{{ isset($attribute) ? $attribute->name : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="توضیحات را وارد کنید" value="{{ isset($attribute) ? $attribute->description : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="guide_link" class="form-label">لینک راهنما</label>
                            <input type="text" class="form-control" id="guide_link" name="guide_link" placeholder="لینک راهنما را وارد کنید" value="{{ isset($attribute) ? $attribute->guide_link : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="display_type" class="form-label">نوع ویژگی</label>
                            <select class="form-control" id="display_type" name="display_type" required>
                                <option value="color" {{ isset($attribute) && $attribute->display_type == 'color' ? 'selected' : '' }}>رنگ</option>
                                <option value="options" {{ isset($attribute) && $attribute->display_type == 'options' ? 'selected' : '' }}>انتخابی</option>
                                @if (isset($pro))
                                    <option value="value" {{ isset($attribute) && $attribute->display_type == 'value' ? 'selected' : '' }}>مقداری</option>
                                    <option value="size" {{ isset($attribute) && $attribute->display_type == 'size' ? 'selected' : '' }}>سایز</option>
                                    <option value="material" {{ isset($attribute) && $attribute->display_type == 'material' ? 'selected' : '' }}>جنس</option>
                                    <option value="model" {{ isset($attribute) && $attribute->display_type == 'model' ? 'selected' : '' }}>مدل</option>
                                    <option value="priceModel" {{ isset($attribute) && $attribute->display_type == 'priceModel' ? 'selected' : '' }}>مدل قیمت دار</option>
                                        
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="unit" class="form-label">واحد</label>
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="واحد ویژگی را وارد کنید" value="{{ isset($attribute) ? $attribute->unit : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="countable" class="form-label">قابل شمارش</label>
                            <select class="form-control" id="countable" name="countable" required>
                                <option value="1" {{ isset($attribute) && $attribute->countable == 1 ? 'selected' : '' }}>بله</option>
                                <option value="0" {{ isset($attribute) && $attribute->countable == 0 ? 'selected' : '' }}>خیر</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="independent" class="form-label">ویژگی مستقل</label>
                            <select class="form-control" id="independent" name="independent" required>
                                <option value="0" {{ isset($attribute) && $attribute->independent == 0 ? 'selected' : '' }}>خیر</option>
                                <option class="disabled" value="1" {{ isset($attribute) && $attribute->independent == 1 ? 'selected' : '' }}>بله</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">{{ isset($attribute) ? 'به روز رسانی' : 'ایجاد' }}</button>
            </div>
        </div>
    </div>
    <!-- PARENT -->
</form>


<!-- CHILDREN -->
@if(isset($attribute) && $attribute->properties->count() > 0)
    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>دسته های فرزند</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>مقدار</th>
                            <th>توضیحات</th>
                            <th>تصویر</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attribute->properties as $propertie)
                            <tr>
                                <td>{{ $propertie->value }}</td>
                                <td>{{ $propertie->description }}</td>
                                <td>
                                    @if($propertie->img)
                                        <img src="{{ asset($propertie->img) }}" alt="تصویر خصوصیت" width="50">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('attribute.properties.edit', $propertie->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                    @if(isset($propertie))
                                        <form method="post" action="{{ route('attribute.properties.delete') }}" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $propertie->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
<!-- CHILDREN -->
@endsection
