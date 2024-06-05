<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ایجاد محصول جدید')


@section('content')
    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="row post-type-row" id="product-form">
    @if(isset($product))
        @method('PUT')
        <input type="hidden" value="{{ $product->id }}" name="product">
    @endif
    @csrf
        <div class="col-lg-8 col-xl-9">
            <div class="card mb-7">
                <div class="card-body">
                    <div class="mb-10">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ isset($product) ? $product->title : '' }}" placeholder="عنوان را وارد کنید" />
                    </div>
                    <div class="mb-2 mt-10">
                        <label class="form-label ">توضیحات</label>
                        <div class="row row-editor">
                            <div class="editor-container">
                                <textarea id="description" name="description" class="editor tw-max-h-96 tw-overflow-auto">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header py-4">
                    <div class="card-title">
                        <h4>اطلاعات محصول</h4>
                    </div>
                    <select class="form-select form-select-solid tw-w-max" name="service" id="service">
                        <option value="0" {{ isset($product) && $product->service == 0 ? 'selected' : '' }}>محصول </option>
                        <option value="1" {{ isset($product) && $product->service == 1 ? 'selected' : '' }}>خدمت</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">انبار</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">حمل و نقل</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-relation" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">متغیر های وابسته</button>
                        <button class="nav-link" id="v-pills-norelation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-norelation" type="button" role="tab" aria-controls="v-pills-norelation" aria-selected="false">متغیر های مستقل</button>
                        <button class="nav-link" id="v-pills-installments-tab" data-bs-toggle="pill" data-bs-target="#v-pills-installments" type="button" role="tab" aria-controls="v-pills-norelation" aria-selected="false">پرداخت اقساطی</button>
                    </div>
                    <div class="tab-content mt-6 border-top pt-6" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <div class="row">
                                <div class="mb-5 col-xl-7">
                                    <label for="holo_code" class="form-label">شناسه محصول</label>
                                    <input type="text" class="form-control form-control-solid" id="holo_code" value="{{ isset($product) ? $product->holo_code : '' }}">
                                </div>
                                <div class="mb-5 col-xl-7">
                                    <label for="price" class="form-label">قیمت (تومان)</label>
                                    <input type="number" class="form-control form-control-solid" id="price" name="price" value="{{ isset($product) ? $product->price : '' }}">
                                </div>

                                <div class="mb-5 col-xl-7">
                                    <label for="sale_price" class="form-label">قیمت فروش ویژه (تومان)</label>
                                    <input type="number" class="form-control form-control-solid" id="sale_price" name="sale_price" value="{{ isset($product) ? $product->sale_price : '' }}">
                                </div>

                                <div class="mb-5 col-xl-7">
                                    <label for="wholesale_price" class="form-label">قیمت عمده‌فروشی (تومان)</label>
                                    <input type="number" class="form-control form-control-solid" id="wholesale_price" name="wholesale_price" value="{{ isset($product) ? $product->wholesale_price : '' }}">
                                </div>

                                <div class="mb-5 col-xl-7">
                                    <label for="few" class="form-label">موجودی</label>
                                    <input type="number" class="form-control form-control-solid" id="few" name="few" value="{{ isset($product) ? $product->few : '' }}">
                                </div>


                                <div class="mb-3 col-xl-7">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{ isset($product) ? ($product->type=='variation' ? "checked" : "" ): ""}} id="type" name="type">
                                        <label class="form-check-label" for="type">
                                            کالای متغیر
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <div class="row">
                                <div class="mb-5 col-xl-6">
                                    <label for="weight" class="form-label">وزن (کیلوگرم)</label>
                                    <input type="text" class="form-control form-control-solid" id="weight" name="weight" value="{{ isset($product) ? $product->weight : '' }}">
                                </div>
                                <div class="mb-5 col-xl-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="length" class="form-label">طول (سانتی متر)</label>
                                            <input type="text" class="form-control form-control-solid" id="length" name="length" value="{{ isset($product) ? $product->length : '' }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="width" class="form-label">عرض (سانتی متر)</label>
                                            <input type="text" class="form-control form-control-solid" id="width" name="width" value="{{ isset($product) ? $product->width : '' }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="height" class="form-label">ارتفاع (سانتی متر)</label>
                                            <input type="text" class="form-control form-control-solid" id="height" name="height" value="{{ isset($product) ? $product->height : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-relation" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">

                            <div>
                                <label class="form-label" for="">انتخاب ویژگی</label>
                                <select class="form-select form-select-solid" data-control="select2" name="attributes[]" id="attributes" multiple>
                                    @foreach ($attributes as $attribute)
                                        @if ($attribute->independent == 0)
                                            <option value="{{ $attribute->id }}"
                                                @if(isset($product) and $product->attributes->contains($attribute->id))
                                                    @php
                                                        $selectedAttributes[] = $attribute->id;
                                                    @endphp
                                                    selected
                                                @endif>
                                                {{ $attribute->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" id="updateAttributesButton" class="btn btn-sm btn-primary mt-2">به روز رسانی</button>

                            <div class="mt-7">
                                @if (isset($product->attributeCombinations))
                                    @if (isset($selectedAttributes))
                                        <div class="card border border-gray-300">
                                            <div class="card-header py-2">
                                                @foreach ($product->getCombinations() as $combination)
                                                    <div class="d-flex align-items-center justify-content-between w-100">
                                                        <b><a href="#collapse{{ $loop->index + 1 }}" data-bs-toggle="collapse">#{{ $loop->index + 1 }}</a></b>
                                                        <div class="container">
                                                                @php
                                                                    $count = 0;
                                                                @endphp


                                                                @foreach ($selectedAttributes as $attributeId)
                                                                    @php
                                                                        $attribute = $attributes->firstWhere('id', $attributeId);
                                                                        $property = $combination->attributeProperties->firstWhere('attribute_id', $attributeId) ? $combination->attributeProperties->firstWhere('attribute_id', $attributeId)->property : null;
                                                                    @endphp
                                                                    @if($count % 3 == 0)
                                                                        <div class="d-flex align-items-center gap-4 mb-3">
                                                                    @endif
                                                                    <div class="flex-fill">
                                                                        <select class="form-select form-select-solid" name="attributes[{{ $attribute->id }}]" id="attribute_{{ $attribute->id }}">
                                                                            <option selected disabled>انتخاب {{ $attribute->name }}</option>
                                                                            @foreach ($attribute->properties as $propertyOption)
                                                                                <option value="{{ $propertyOption->id }}" @if($property && $propertyOption->id == $property->id) selected @endif>{{ $propertyOption->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @php
                                                                        $count++;
                                                                    @endphp
                                                                    @if($count % 3 == 0)
                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                            @if($count % 3 != 0)
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="collapse" id="collapse{{ $loop->index + 1 }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-8">
                                                                        <label for="holo_code_{{ $loop->index + 1 }}" class="form-label">شناسه محصول</label>
                                                                        <input type="text" class="form-control form-control-solid" id="holo_code_{{ $loop->index + 1 }}" name="combinations[{{ $loop->index }}][holo_code]" value="{{ $combination->holo_code }}" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="mb-8">
                                                                        <label for="price_{{ $loop->index + 1 }}" class="form-label">قیمت اصلی</label>
                                                                        <input type="text" class="form-control form-control-solid" id="price_{{ $loop->index + 1 }}" name="combinations[{{ $loop->index }}][price]" value="{{ $combination->price }}" placeholder="قیمت(تومان)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="mb-8">
                                                                        <label for="sale_price_{{ $loop->index + 1 }}" class="form-label">قیمت فروش ویژه</label>
                                                                        <input type="text" class="form-control form-control-solid" id="sale_price_{{ $loop->index + 1 }}" name="combinations[{{ $loop->index }}][sale_price]" value="{{ $combination->sale_price }}" placeholder="قیمت(تومان)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="mb-8">
                                                                        <label for="wholesale_price_{{ $loop->index + 1 }}" class="form-label">قیمت فروش عمده</label>
                                                                        <input type="text" class="form-control form-control-solid" id="wholesale_price_{{ $loop->index + 1 }}" name="combinations[{{ $loop->index }}][wholesale_price]" value="{{ $combination->wholesale_price }}" placeholder="قیمت(تومان)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="mb-8">
                                                                        <label for="stock_quantity_{{ $loop->index + 1 }}" class="form-label">موجودی</label>
                                                                        <input type="number" class="form-control form-control-solid" id="stock_quantity_{{ $loop->index + 1 }}" name="combinations[{{ $loop->index }}][stock_quantity]" value="{{ $combination->stock_quantity }}" placeholder="موجودی">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-8">
                                                                        <label for="description_{{ $loop->index + 1 }}" class="form-label">توضیحات</label>
                                                                        <textarea class="form-control form-control-solid" id="description_{{ $loop->index + 1 }}" name="combinations[{{ $loop->index }}][description]" rows="3">{{ $combination->description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="images-repeater w-100">
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="edit_block_repeater_{{ $loop->index + 1 }}">
                                                                                <div class="mt-3" data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-10">
                                                                                            <label class="form-label">تصویر:</label>
                                                                                            <input name="combinations[{{ $loop->index }}][images][]" type="file" class="form-control form-control-solid mb-2 mb-md-0" placeholder="وارد کنید" />
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                                                <i class="ki-duotone ki-trash fs-5"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mt-5">
                                                                            <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                                                                                افزودن تصویر جدید
                                                                                <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-norelation" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">

                            <div>
                                <label class="form-label" for="">انتخاب ویژگی مستقل</label>
                                <select class="form-select form-select-solid" data-control="select2" name="attributes_independent[]" id="attributes_independent" multiple>
                                    @foreach ($attributes as $attribute)
                                        @if ($attribute->independent == 1)
                                            <option value="{{ $attribute->id }}"
                                                @if(isset($product) and $product->attributes->contains($attribute->id))
                                                    @php
                                                        $selectedAttributes2[] = $attribute;
                                                    @endphp
                                                    selected
                                                @endif>
                                                {{ $attribute->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" id="updateIndependentAttributesButton" class="btn btn-sm btn-primary mt-2">به روز رسانی</button>


                            <div class="mt-7">
                                @if (isset($selectedAttributes2))
                                    @foreach ($selectedAttributes2 as $attribute)
                                        @if ($attribute->independent == 1)
                                            @foreach ($attribute->properties as $propertyOption)
                                                <div class="card border border-gray-300">
                                                    <div class="card-header py-2">
                                                        <div class="d-flex align-items-center justify-content-between w-100">
                                                            <b><a href="#collapse{{ $attribute->id }}_{{ $propertyOption->id }}" data-bs-toggle="collapse">#{{ $attribute->id }}_{{ $propertyOption->id }}</a></b>
                                                            <div class="container">
                                                                @php
                                                                    $count = 0;
                                                                @endphp

                                                                @if($count % 3 == 0)
                                                                    <div class="d-flex align-items-center gap-4 mb-3">
                                                                @endif
                                                                    <div class="flex-fill">
                                                                        <select class="form-select form-select-solid attribute-property" name="attributes[{{ $attribute->id }}]" id="attribute_{{ $attribute->id }}">
                                                                            <option selected disabled>انتخاب {{ $attribute->name }}</option>
                                                                                <option value="{{ $propertyOption->id }}" selected>{{ $propertyOption->value }}</option>
                                                                        </select>
                                                                    </div>
                                                                @php
                                                                    $count++;
                                                                @endphp
                                                                @if($count % 3 == 0)
                                                                    </div>
                                                                @endif

                                                                @if($count % 3 != 0)
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @php
                                                            $combinationSelected = null;
                                                            foreach ($product->getCombinations() as $combination) {
                                                                if ($combination->hasProperty($propertyOption->id)) {
                                                                    $combinationSelected = $combination;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        <div class="collapse" id="collapse{{ $attribute->id }}_{{ $propertyOption->id }}">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-8">
                                                                            <label for="holo_code_{{ $propertyOption->id }}" class="form-label">شناسه محصول</label>
                                                                            <input type="text" class="form-control form-control-solid" id="holo_code_{{ $propertyOption->id }}" name="combinations[{{ $propertyOption->id }}][holo_code]" value="{{ $combinationSelected->holo_code ?? '' }}" placeholder="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <div class="mb-8">
                                                                            <label for="price_{{ $propertyOption->id }}" class="form-label">قیمت اصلی</label>
                                                                            <input type="text" class="form-control form-control-solid" id="price_{{ $propertyOption->id }}" name="combinations[{{ $propertyOption->id }}][price]" value="{{ $combinationSelected->price ?? '' }}" placeholder="قیمت(تومان)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <div class="mb-8">
                                                                            <label for="sale_price_{{ $propertyOption->id }}" class="form-label">قیمت فروش ویژه</label>
                                                                            <input type="text" class="form-control form-control-solid" id="sale_price_{{ $propertyOption->id }}" name="combinations[{{ $propertyOption->id }}][sale_price]" value="{{ $combinationSelected->sale_price ?? '' }}" placeholder="قیمت(تومان)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <div class="mb-8">
                                                                            <label for="wholesale_price_{{ $propertyOption->id }}" class="form-label">قیمت فروش عمده</label>
                                                                            <input type="text" class="form-control form-control-solid" id="wholesale_price_{{ $propertyOption->id }}" name="combinations[{{ $propertyOption->id }}][wholesale_price]" value="{{ $combinationSelected->wholesale_price ?? '' }}" placeholder="قیمت(تومان)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <div class="mb-8">
                                                                            <label for="stock_quantity_{{ $propertyOption->id }}" class="form-label">موجودی</label>
                                                                            <input type="number" class="form-control form-control-solid" id="stock_quantity_{{ $propertyOption->id }}" name="combinations[{{ $propertyOption->id }}][stock_quantity]" value="{{ $combinationSelected->stock_quantity ?? '' }}" placeholder="موجودی">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="mb-8">
                                                                            <label for="description_{{ $propertyOption->id }}" class="form-label">توضیحات</label>
                                                                            <textarea class="form-control form-control-solid" id="description_{{ $propertyOption->id }}" name="combinations[{{ $propertyOption->id }}][description]" rows="3">{{ $combinationSelected->description ?? '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="images-repeater w-100">
                                                                            <div class="form-group">
                                                                                <div data-repeater-list="edit_block_repeater_{{ $propertyOption->id }}">
                                                                                    <div class="mt-3" data-repeater-item>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">تصویر:</label>
                                                                                                <input name="combinations[{{ $propertyOption->id }}][images][]" type="file" class="form-control form-control-solid mb-2 mb-md-0" placeholder="وارد کنید" />
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                                                    <i class="ki-duotone ki-trash fs-5"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mt-5">
                                                                                <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                                                                                    افزودن تصویر جدید
                                                                                    <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-installments" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">
                            <div class="row">
                                <div class="mb-5 col-xl-7">
                                    <label for="" class="form-label">پلن های اقساطی این محصول</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="" id="" multiple>
                                        <option value="1">پلن 1</option>
                                        <option value="2">پلن 2</option>
                                        <option value="3">پلن 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-10">
                <div class="card-body">
                    <label class="form-label ">شرح</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <textarea id="article[description]" name="article[description]" class="editor tw-max-h-96 tw-overflow-auto">{{ old('article[description]', isset($product) ? $product->article->description : '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-10">
                <div class="card-body">
                    <label class="form-label ">توضیحات تکمیلی</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <textarea id="article[specification]" name="article[specification]" class="editor tw-max-h-96 tw-overflow-auto">{{ old('article[specification]', isset($product) ? $product->article->description : '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-10">
                <div class="card-body">
                    <label class="form-label ">راهنمای اندازه گیری</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <textarea id="article[guide]" name="article[guide]" class="editor tw-max-h-96 tw-overflow-auto">{{ old('article[guide]', isset($product) ? $product->article->guide : '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>





        </div>

        <div class="col-lg-4 col-xl-3 mt-5 mt-lg-0">
            <!-- START:STATUS -->
            <div class="card card-flush py-4 mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h4>وضعیت</h4>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <select class="form-select mb-2" name="status">
                        <option value="published" {{ isset($product) && $product->status == 'published' ? 'selected' : '' }}>منتشر شده</option>
                        <option value="inactive" {{ isset($product) && $product->status == 'inactive' ? 'selected' : '' }}>پیش نویس</option>
                    </select>
                    <div class="text-muted fs-7">وضعیت نوشته را تنظیم کنید.</div>
                    <div class="form-check mt-5">
                        <input class="form-check-input" type="checkbox" name="reviews_enabled" value="1" id="flexCheckChecked" {{ isset($product) && $product->reviews_enabled ? 'checked' : '' }} />
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                            فعال بودن دیدگاه ها
                        </label>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <button type="submit" class="btn btn-sm btn-success">ذخیره تغییرات</button>
                    </div>
                </div>
            </div>
            <!-- END:STATUS -->

            <!-- START:CATEGORY -->
            <div class="card card-flush py-4 mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h4>دسته بندی ها</h4>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="tw-max-h-56 tw-overflow-auto tw-pt-1">
                        <ul class="intermediat-checkbox category-list">
                            @foreach($categories as $category)
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category{{ $category->id }}" name="categories[]" {{ isset($product) && $product->categories->contains($category->id) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->title }}
                                    </label>
                                </div>
                                @if($category->children)
                                    <ul>
                                        @foreach($category->children as $child)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $child->id }}" id="category{{ $child->id }}" name="categories[]" {{ isset($product) && $product->categories->contains($child->id) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="category{{ $child->id }}">
                                                    {{ $child->title }}
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#add-fast-category">افزودن دسته ی جدید</button>
                </div>
            </div>
            <!-- END:CATEGORY -->

            <!-- START:TAGS -->
            <div class="card card-flush py-4 mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h4>برچسب ها</h4>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <input class="form-control form-control-solid" id="product-type-tags" name="tags" value="{{ isset($product) ? implode(',', $product->tags->pluck('name')->toArray()) : '' }}" />
                    <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
                </div>
            </div>
            <!-- END:TAGS -->

            <!-- START: THUMBNAIL -->
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h4>ویدئو</h4>
                    </div>
                </div>
                <div class="card-body text-center pt-0">
                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                        <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ isset($product) ? asset($product->video_path) : '' }}');"></div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض ویدئو">
                            <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                            <input type="file" name="video" accept="video/mp4" />
                            <input type="hidden" name="video_remove" />
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف">
                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف ویدئو">
                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                    </div>
                    <div class="text-muted fs-7">ویدئو محصول را انتخاب کنید</div>
                </div>
            </div>
            <!-- END:THUMBNAIL -->
        </div>

    <x-add-fast-category />
    </form>
@endsection

@section("script-before")
<script src="{{ asset('/js/ckeditor.js') }}"></script>
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;
    $('.images-repeater').repeater({
        initEmpty: false,

        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
    flatpickr = $(".first_time,.second_time").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
    })

    // FOR REMOVE BUTTON CONFIRM
    document.addEventListener("DOMContentLoaded", () => {
        new Tagify(document.querySelector('#product-type-tags'), {
            whitelist: ['دسته پیشفرض']
        })
        $("#remove-button").on("click", (e) => {
            e.preventDefault();
            Swal.fire({
                title: "آیا مطمعن هستید ؟",
                icon: "info",
                cancelButtonColor: "#f1416c",
                showCancelButton: true,
                confirmButtonText: "بله",
                cancelButtonText: "خیر"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#product-form").submit();
                }
            });
        })
    })
</script>


<script>
document.getElementById('attributes').addEventListener('change', function () {
    const attributeIds = Array.from(this.selectedOptions).map(option => option.value);
    const container = document.getElementById('attribute-options-container');
    container.innerHTML = '';

    attributeIds.forEach(attributeId => {
        fetch(`/products/attributes/attribute-options/${attributeId}`)
            .then(response => response.json())
            .then(options => {
                const attributeSelect = document.createElement('select');
                attributeSelect.className = 'form-select form-select-solid mt-3';
                attributeSelect.name = `attribute_options[${attributeId}][]`;
                attributeSelect.multiple = true;

                options.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.id;
                    optionElement.textContent = option.name;
                    attributeSelect.appendChild(optionElement);
                });

                container.appendChild(attributeSelect);
            })
            .catch(error => console.error('Error loading attribute options:', error));
    });
});

let combinationIndex = 1;

function addCombination() {
    const container = document.getElementById('combinations-container');
    const newCombination = document.createElement('div');
    newCombination.className = 'card border border-gray-300 combination-card';
    newCombination.setAttribute('data-index', combinationIndex);

    newCombination.innerHTML = `
        <div class="card-header py-2">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="d-flex align-items-center gap-4">
                    <b>#${combinationIndex}</b>
                    <div class="attribute-selects" data-index="${combinationIndex}">
                        <!-- اینجا انتخابگرهای ویژگی به صورت پویا اضافه خواهند شد -->
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#collapse${combinationIndex}" aria-expanded="false" aria-controls="collapse${combinationIndex}">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
        </div>
        <div class="collapse" id="collapse${combinationIndex}">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-8">
                            <label for="holo_code_${combinationIndex}" class="form-label">شناسه محصول</label>
                            <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][holo_code]" id="holo_code_${combinationIndex}" placeholder="">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-8">
                            <label for="price_${combinationIndex}" class="form-label">قیمت اصلی</label>
                            <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][price]" id="price_${combinationIndex}" placeholder="قیمت(تومان)">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-8">
                            <label for="sale_price_${combinationIndex}" class="form-label">قیمت فروش ویژه</label>
                            <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][sale_price]" id="sale_price_${combinationIndex}" placeholder="قیمت(تومان)">
                            <a class="text-primary" data-bs-toggle="collapse" href="#timing1_${combinationIndex}">زمان بندی فروش</a>
                        </div>
                    </div>
                    <div class="collapse col-12" id="timing1_${combinationIndex}">
                        <div class="row mb-8">
                            <div class="col-12 col-lg-6">
                                <label class="form-label" for="sale_start_date_${combinationIndex}">تاریخ شروع فروش ویژه</label>
                                <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][sale_start_date]" id="sale_start_date_${combinationIndex}">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label" for="sale_end_date_${combinationIndex}">تاریخ پایان فروش ویژه</label>
                                <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][sale_end_date]" id="sale_end_date_${combinationIndex}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-8">
                            <label for="stock_${combinationIndex}" class="form-label">موجودی</label>
                            <select class="form-select form-select-solid" name="combinations[${combinationIndex}][stock]" id="stock_${combinationIndex}">
                                <option value="in_stock">موجود در انبار</option>
                                <option value="out_of_stock">در انبار موجود نمیباشد</option>
                                <option value="pre_order">در پیش خرید</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-8">
                            <label for="weight_${combinationIndex}" class="form-label">وزن ( کیلوگر)</label>
                            <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][weight]" id="weight_${combinationIndex}" placeholder="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <label class="form-label">ابعاد ( سانتی متر)</label>
                            <div class="col-4">
                                <div class="mb-8">
                                    <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][dimensions][length]" placeholder="طول">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-8">
                                    <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][dimensions][width]" placeholder="عرض">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-8">
                                    <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][dimensions][height]" placeholder="ارتفاع">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-8">
                            <label for="description_${combinationIndex}" class="form-label">توضیحات</label>
                            <textarea class="form-control form-control-solid" name="combinations[${combinationIndex}][description]" id="description_${combinationIndex}" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="images-repeater w-100">
                            <div class="form-group">
                                <div data-repeater-list="combinations[${combinationIndex}][images]">
                                    <div class="mt-3" data-repeater-item>
                                        <div class="form-group row">
                                            <div class="col-md-10">
                                                <label class="form-label">تصویر:</label>
                                                <input name="image" type="file" class="form-control form-control-solid mb-2 mb-md-0" placeholder="وارد کنید" />
                                            </div>
                                            <div class="col-md-2">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                    <i class="ki-duotone ki-trash fs-5"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                                    افزودن تصویر جدید
                                    <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.insertBefore(newCombination, container.lastElementChild);

    loadAttributeSelects(combinationIndex);

    combinationIndex++;
}

function loadAttributeSelects(index) {
    const attributeIds = Array.from(document.getElementById('attributes').selectedOptions).map(option => option.value);
    const container = document.querySelector(`.attribute-selects[data-index="${index}"]`);
    container.innerHTML = '';

    attributeIds.forEach(attributeId => {
        fetch(`/attribute-options/${attributeId}`)
            .then(response => response.json())
            .then(options => {
                const attributeSelect = document.createElement('select');
                attributeSelect.className = 'form-select form-select-solid mt-3';
                attributeSelect.name = `combinations[${index}][attribute_options][${attributeId}]`;
                attributeSelect.multiple = true;

                options.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.id;
                    optionElement.textContent = option.name;
                    attributeSelect.appendChild(optionElement);
                });

                container.appendChild(attributeSelect);
            })
            .catch(error => console.error('Error loading attribute options:', error));
    });
}

document.getElementById('combinations-container').addEventListener('click', function (e) {
    if (e.target.closest('[data-repeater-delete]')) {
        e.target.closest('.combination-card').remove();
    }
});

</script>


<!-- جاوااسکریپت -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButton = document.getElementById('updateAttributesButton');
        const updateIndependentButton = document.getElementById('updateIndependentAttributesButton');
        const selectDependent = document.getElementById('attributes');
        const selectIndependent = document.getElementById('attributes_independent');

        function updateAttributes() {
            const selectedDependent = Array.from(selectDependent.selectedOptions).map(option => option.value);
            const selectedIndependent = Array.from(selectIndependent.selectedOptions).map(option => option.value);

            const combinedAttributes = [...selectedDependent, ...selectedIndependent];

            fetch('/products/update-attributes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: @json($product->id),
                    attributes: combinedAttributes
                })
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    console.error('Failed to update attributes');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        updateButton.addEventListener('click', updateAttributes);
        updateIndependentButton.addEventListener('click', updateAttributes);
    });
</script>
@endsection
