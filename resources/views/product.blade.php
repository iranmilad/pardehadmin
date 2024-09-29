<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ایجاد محصول جدید')


@section('content')
    <form method="post" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" enctype="multipart/form-data" class="row post-type-row" id="product-form">
        @if(isset($product))
            @method('PUT')
            <input type="hidden" value="{{ $product->id }}" name="product">
        @endif
        @csrf
        <div class="row">

            <div class="col-8 col-lg-8 col-xl-9">
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

                @if (isset($product))
                    <div class="card mb-7">
                        <div class="card-header py-4">
                            <div class="card-title">
                                <h4>اطلاعات محصول</h4>
                            </div>
                            <select class="form-select form-select-solid tw-w-max" name="service" id="service">
                                <option value="0" {{ isset($product) && $product->service == 0 ? 'selected' : '' }}>محصول </option>
                                <option value="1" {{ isset($product) && $product->service == 1 ? 'selected' : '' }} disabled>خدمت</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">انبار</button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">حمل و نقل</button>
                                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-relation" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">متغیر های وابسته</button>
                                <button class="nav-link d-none" id="v-pills-norelation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-norelation" type="button" role="tab" aria-controls="v-pills-norelation" aria-selected="false">متغیر های مستقل</button>
                                <button class="nav-link d-none" id="v-pills-installments-tab" data-bs-toggle="pill" data-bs-target="#v-pills-installments" type="button" role="tab" aria-controls="v-pills-installments" aria-selected="false">پرداخت اقساطی</button>
                                <button class="nav-link d-none" id="v-pills-services-tab" data-bs-toggle="pill" data-bs-target="#v-pills-services" type="button" role="tab" aria-controls="v-pills-services" aria-selected="false">سرویس مکمل</button>

                            </div>
                            <div class="tab-content mt-6 border-top pt-6" id="v-pills-tabContent">
                                
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                                    <livewire:product-attributes-manager :product="$product" />
                                </div>
                              
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                    <livewire:product-transport :product="$product" />
                                </div>
                                <div class="tab-pane fade" id="v-pills-relation" role="tabpanel" aria-labelledby="v-pills-relation-tab" tabindex="0">
                                    <livewire:product-attributes :id="$product->id" />
                                </div>
                                <div class="tab-pane fade" id="v-pills-norelation" role="tabpanel" aria-labelledby="v-pills-norelation-tab" tabindex="0">
                                    <livewire:product-independent-attributes :id="$product->id" />
                                </div>
                                <div class="tab-pane fade" id="v-pills-installments" role="tabpanel" aria-labelledby="v-pills-installments-tab" tabindex="0">
                                    <livewire:product-credit-plan :product="$product" />
                                </div>
                                <div class="tab-pane fade" id="v-pills-services" role="tabpanel" aria-labelledby="v-pills-services-tab" tabindex="0">
                                    <livewire:service-category-selector :productId="$product->id" />
                                </div>

                            </div>

                        </div>
                    </div>
                @endif

                @if (isset($product))
                    <div class="card mb-7">
                        <div class="card-body">
                            <label class="form-label ">راهنمای اندازه گیری</label>
                            <div class="row row-editor">
                                <div class="editor-container">

                                    <textarea id="guide" name="guide" class="editor tw-max-h-96 tw-overflow-auto">{{ old('guide', isset($product) ? isset($product->article) ? $product->article->guide : '' : '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-4 col-lg-4 col-xl-3">
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
                            <input class="form-check-input" type="checkbox" name="reviews_enabled"  id="reviews_enabled" value="1" {{ isset($product) && $product->reviews_enabled ? 'checked' : '' }} />
                            <label class="form-check-label text-dark" for="reviews_enabled">
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
                        <a class="nav-link" type="button" href="{{ route('categories.index') }}">افزودن دسته ی جدید</a>
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
                        <input class="form-control form-control-solid" id="product-type-tags" name="tags" value="{{ old("tags", isset($product) ? json_encode($product->tags->pluck("name")->toArray()) : "[]") }}" />
                        <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
                    </div>
                </div>
                <!-- END:TAGS -->

                <!-- START: THUMBNAIL -->
                <div class="card card-flush py-4 mb-5">
                    <!--begin::کارت header-->
                    <div class="card-header">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <h4>تصویر شاخص</h4>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--end::Image input placeholder-->
                        @if(isset($product))
                            <x-file-input type="single" :preview="true" name="img" :value="$product->img" />
                        @else
                            <x-file-input type="single" :preview="true" name="img" />
                        @endif
                        <!--end::Image input-->
                        <!--begin::توضیحات-->
                        <div class="text-muted fs-7">تصویر شاخص را انتخاب کنید</div>
                        <!--end::توضیحات-->
                    </div>
                    <!--end::کارت body-->
                </div>
                <!-- END:THUMBNAIL -->

                <!-- START: THUMBNAIL -->
                <div class="card card-flush py-4 mb-5">
                    <!--begin::کارت header-->
                    <div class="card-header">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <h4>گالری تصویر</h4>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body text-center pt-0">

                        @php
                            $imageUrls = isset($product) && $product->images ? $product->images->pluck('url')->toArray() : null;
                        @endphp
                        <x-file-input type="multiple" :preview="true" name="gallery" :value='$imageUrls' />


                    </div>
                    <!--end::کارت body-->
                </div>
                <!-- END:THUMBNAIL -->


                <!-- START: VIDEO THUMBNAIL -->
                <div class="card card-flush py-4">
                    <!--begin::کارت header-->
                    <div class="card-header">
                        <!--begin::کارت title-->
                        <div class="card-title">
                            <h4>ویدئو</h4>
                        </div>
                        <!--end::کارت title-->
                    </div>
                    <!--end::کارت header-->
                    <!--begin::کارت body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        @if(isset($product))
                            <x-file-input type="single" :preview="false" name="video_path" :value="$product->video_path"/>
                        @else
                            <x-file-input type="single" :preview="false" name="video_path" />
                        @endif
                        <!--begin::توضیحات-->
                        <div class="text-muted text-center">ویدئو محصول را انتخاب کنید</div>
                        <!--end::توضیحات-->
                    </div>
                    <!--end::کارت body-->
                </div>
                <!-- END:VIDEO THUMBNAIL -->
            </div>
        </div>



    </form>
    <x-add-fast-category />
    <x-short-code-editor />
@endsection

@section("script-before")

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
// document.getElementById('attributes').addEventListener('change', function () {
//     const attributeIds = Array.from(this.selectedOptions).map(option => option.value);
//     const container = document.getElementById('attribute-options-container');
//     container.innerHTML = '';

//     attributeIds.forEach(attributeId => {
//         fetch(`/products/attributes/attribute-options/${attributeId}`)
//             .then(response => response.json())
//             .then(options => {
//                 const attributeSelect = document.createElement('select');
//                 attributeSelect.className = 'form-select form-select-solid mt-3';
//                 attributeSelect.name = `attribute_options[${attributeId}][]`;
//                 attributeSelect.multiple = true;

//                 options.forEach(option => {
//                     const optionElement = document.createElement('option');
//                     optionElement.value = option.id;
//                     optionElement.textContent = option.name;
//                     attributeSelect.appendChild(optionElement);
//                 });

//                 container.appendChild(attributeSelect);
//             })
//             .catch(error => console.error('Error loading attribute options:', error));
//     });
// });

// let combinationIndex = 1;

// function addCombination() {
//     const container = document.getElementById('combinations-container');
//     const newCombination = document.createElement('div');
//     newCombination.className = 'card border border-gray-300 combination-card';
//     newCombination.setAttribute('data-index', combinationIndex);

//     newCombination.innerHTML = `
//         <div class="card-header py-2">
//             <div class="d-flex align-items-center justify-content-between w-100">
//                 <div class="d-flex align-items-center gap-4">
//                     <b>#${combinationIndex}</b>
//                     <div class="attribute-selects" data-index="${combinationIndex}">
//                         <!-- اینجا انتخابگرهای ویژگی به صورت پویا اضافه خواهند شد -->
//                     </div>
//                 </div>
//                 <button type="button" class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#collapse${combinationIndex}" aria-expanded="false" aria-controls="collapse${combinationIndex}">
//                     <i class="fas fa-chevron-down"></i>
//                 </button>
//             </div>
//         </div>
//         <div class="collapse" id="collapse${combinationIndex}">
//             <div class="card-body">
//                 <div class="row">
//                     <div class="col-12">
//                         <div class="mb-8">
//                             <label for="holo_code_${combinationIndex}" class="form-label">شناسه محصول</label>
//                             <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][holo_code]" id="holo_code_${combinationIndex}" placeholder="">
//                         </div>
//                     </div>
//                     <div class="col-12 col-lg-6">
//                         <div class="mb-8">
//                             <label for="price_${combinationIndex}" class="form-label">قیمت اصلی</label>
//                             <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][price]" id="price_${combinationIndex}" placeholder="قیمت(تومان)">
//                         </div>
//                     </div>
//                     <div class="col-12 col-lg-6">
//                         <div class="mb-8">
//                             <label for="sale_price_${combinationIndex}" class="form-label">قیمت فروش ویژه</label>
//                             <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][sale_price]" id="sale_price_${combinationIndex}" placeholder="قیمت(تومان)">
//                             <a class="text-primary" data-bs-toggle="collapse" href="#timing1_${combinationIndex}">زمان بندی فروش</a>
//                         </div>
//                     </div>
//                     <div class="collapse col-12" id="timing1_${combinationIndex}">
//                         <div class="row mb-8">
//                             <div class="col-12 col-lg-6">
//                                 <label class="form-label" for="sale_start_date_${combinationIndex}">تاریخ شروع فروش ویژه</label>
//                                 <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][sale_start_date]" id="sale_start_date_${combinationIndex}">
//                             </div>
//                             <div class="col-12 col-lg-6">
//                                 <label class="form-label" for="sale_end_date_${combinationIndex}">تاریخ پایان فروش ویژه</label>
//                                 <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][sale_end_date]" id="sale_end_date_${combinationIndex}">
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col-12 col-lg-6">
//                         <div class="mb-8">
//                             <label for="stock_${combinationIndex}" class="form-label">موجودی</label>
//                             <select class="form-select form-select-solid" name="combinations[${combinationIndex}][stock]" id="stock_${combinationIndex}">
//                                 <option value="in_stock">موجود در انبار</option>
//                                 <option value="out_of_stock">در انبار موجود نمیباشد</option>
//                                 <option value="pre_order">در پیش خرید</option>
//                             </select>
//                         </div>
//                     </div>
//                     <div class="col-12 col-lg-6">
//                         <div class="mb-8">
//                             <label for="weight_${combinationIndex}" class="form-label">وزن ( کیلوگر)</label>
//                             <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][weight]" id="weight_${combinationIndex}" placeholder="">
//                         </div>
//                     </div>
//                     <div class="col-12">
//                         <div class="row">
//                             <label class="form-label">ابعاد ( سانتی متر)</label>
//                             <div class="col-4">
//                                 <div class="mb-8">
//                                     <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][dimensions][length]" placeholder="طول">
//                                 </div>
//                             </div>
//                             <div class="col-4">
//                                 <div class="mb-8">
//                                     <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][dimensions][width]" placeholder="عرض">
//                                 </div>
//                             </div>
//                             <div class="col-4">
//                                 <div class="mb-8">
//                                     <input type="text" class="form-control form-control-solid" name="combinations[${combinationIndex}][dimensions][height]" placeholder="ارتفاع">
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col-12">
//                         <div class="mb-8">
//                             <label for="description_${combinationIndex}" class="form-label">توضیحات</label>
//                             <textarea class="form-control form-control-solid" name="combinations[${combinationIndex}][description]" id="description_${combinationIndex}" rows="3"></textarea>
//                         </div>
//                     </div>
//                     <div class="col-12">
//                         <div class="images-repeater w-100">
//                             <div class="form-group">
//                                 <div data-repeater-list="combinations[${combinationIndex}][images]">
//                                     <div class="mt-3" data-repeater-item>
//                                         <div class="form-group row">
//                                             <div class="col-md-10">
//                                                 <label class="form-label">تصویر:</label>
//                                                 <input name="image" type="file" class="form-control form-control-solid mb-2 mb-md-0" placeholder="وارد کنید" />
//                                             </div>
//                                             <div class="col-md-2">
//                                                 <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
//                                                     <i class="ki-duotone ki-trash fs-5"></i>
//                                                 </a>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="form-group mt-5">
//                                 <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
//                                     افزودن تصویر جدید
//                                     <i class="ki-duotone ki-plus fs-3 pe-0"></i>
//                                 </a>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `;

//     container.insertBefore(newCombination, container.lastElementChild);

//     loadAttributeSelects(combinationIndex);

//     combinationIndex++;
// }

// function loadAttributeSelects(index) {
//     const attributeIds = Array.from(document.getElementById('attributes').selectedOptions).map(option => option.value);
//     const container = document.querySelector(`.attribute-selects[data-index="${index}"]`);
//     container.innerHTML = '';

//     attributeIds.forEach(attributeId => {
//         fetch(`/attribute-options/${attributeId}`)
//             .then(response => response.json())
//             .then(options => {
//                 const attributeSelect = document.createElement('select');
//                 attributeSelect.className = 'form-select form-select-solid mt-3';
//                 attributeSelect.name = `combinations[${index}][attribute_options][${attributeId}]`;
//                 attributeSelect.multiple = true;

//                 options.forEach(option => {
//                     const optionElement = document.createElement('option');
//                     optionElement.value = option.id;
//                     optionElement.textContent = option.name;
//                     attributeSelect.appendChild(optionElement);
//                 });

//                 container.appendChild(attributeSelect);
//             })
//             .catch(error => console.error('Error loading attribute options:', error));
//     });
// }

// document.getElementById('combinations-container').addEventListener('click', function (e) {
//     if (e.target.closest('[data-repeater-delete]')) {
//         e.target.closest('.combination-card').remove();
//     }
// });

</script>


<!-- جاوااسکریپت -->
<script>
//     document.addEventListener('DOMContentLoaded', function() {
//         const updateButton = document.getElementById('updateAttributesButton');
//         const updateIndependentButton = document.getElementById('updateIndependentAttributesButton');
//         const selectDependent = document.getElementById('attributes');
//         const selectIndependent = document.getElementById('attributes_independent');

//         function updateAttributes() {
//             const selectedDependent = Array.from(selectDependent.selectedOptions).map(option => option.value);
//             const selectedIndependent = Array.from(selectIndependent.selectedOptions).map(option => option.value);

//             const combinedAttributes = [...selectedDependent, ...selectedIndependent];

//             fetch('/products/update-attributes', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({
//                     product_id: @json($product->id ?? null),
//                     attributes: combinedAttributes
//                 })
//             })
//             .then(response => {
//                 if (response.ok) {
//                     location.reload();
//                 } else {
//                     console.error('Failed to update attributes');
//                 }
//             })
//             .catch(error => console.error('Error:', error));
//         }

//         updateButton.addEventListener('click', updateAttributes);
//         updateIndependentButton.addEventListener('click', updateAttributes);
//     });
// </script>

@endsection
