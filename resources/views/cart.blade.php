@extends('layouts.primary')

@if(Route::is('cart.create.show'))
@section('title', 'ایجاد سبد خرید')
@else
@section('title', 'ویرایش سبد خرید')
@endif

@section('content')
<form action="" method="post">
    <div class="card mb-10">
        <div class="card-header">
            <h4 class="card-title">جزئیات سبد</h4>
        </div>
        <div class="card-body">
            <div class="mb-5">
                <x-advanced-search type="user" label="مشتری" name="user" solid />
            </div>
        </div>
    </div>
    <!-- PRODUCTS PATTERN -->
    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>محصولات</h4>
                </div>
            </div>
            <div class="card-body">
                <!-- CHILDREN -->
                <div class="row">
                    <div class="other_repeater">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <!-- data-repeater-list must be unique -->
                            <div data-repeater-list="products_repeater">
                                <div class="mt-3 tw-border-0 tw-border-b-2 tw-border-dashed tw-border-b-gray-200 pb-5" data-repeater-item>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-9">
                                            <x-advanced-search type="product" label="محصول" name="option[product]" solid classes="order_create_product" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                حذف
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                                افزودن
                                <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                            </a>
                        </div>
                        <!--end::Form group-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCTS PATTERN -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">خلاصه سبد</h4>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-column-reverse flex-md-row">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-5 mb-5">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#coupon">افزودن کد تخفیف</button>
                </div>
                <ul class="tw-space-y-3">
                    <li class="fs-6"><span class="fw-bold">کد تخفیف اعمال شده : </span>12OFF</li>
                    <li class="fs-6"><span class="fw-bold">تخفیف اعمال شده : </span>20%</li>
                    <li class="fs-6"><span class="fw-bold">مجموع سفارش: </span>12,000,000</li>
                </ul>
            </div>
        </div>
    </div>
</form>

<!-- START: COUPON -->
<div class="modal fade" id="coupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">کد تخفیف</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <label for="" class="form-label">کد تخفیف</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">اعمال کد تخفیف</button>
            </div>
        </form>
    </div>
</div>
<!-- END: COUPON -->
@endsection

@section("script-before")
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection

@section('scripts')
<script>
    function addProductOrder(select) {
        if (select) {
            select.on('select2:select', function(e) {
                let data = e.params.data;
                if (data.id) {
                    $.ajax({
                        url: `/api/product-options/${data.id}`,
                        success: function(response) {
                            let select = $(e.target);
                            let parent = select.closest('.form-group');
                            response.forEach(function(item) {
                                let div = $("<div>", {
                                    class: "col-12 col-md-4 col-lg-3 p-4 rounded-3 mb-5",
                                })

                                item.multiple ? select.attr('multiple', 'multiple') : '';
                                let label = $("<label>", {
                                    class: "form-label",
                                    text: item.label + ": "
                                });
                                if (item.type === "select") {
                                    var select = $("<select>", {
                                        class: "form-select form-select-solid",
                                        name: item.name,
                                        id: "",
                                    });
                                    item.options.forEach(function(opt) {
                                        let optionElement = $("<option>", {
                                            value: opt.value,
                                            text: opt.name
                                        });
                                        select.append(optionElement);
                                    });
                                }
                                if (item.type === "input") {
                                    var input = $("<input>", {
                                        class: "form-control form-control-solid",
                                        type: "text",
                                        placeholder: "وارد کنید",
                                        name: item.name,
                                        id: "",
                                    });

                                }
                                div.append(label);
                                if (item.type === "select") {
                                    div.append(select);

                                }
                                if (item.type === "input") {
                                    div.append(input);
                                }
                                parent.append(div);
                                setTimeout(() => $(select).select2(), 50);
                            });

                        }
                    })
                }
            });
        }
    }

    $(".other_repeater").repeater({
        initEmpty: false,
        ready: function() {
            let select = $(".other_repeater select")
            addProductOrder(select);
        },
        show: function() {
            $(this).slideDown();
            let select = $(this).find("select").select2({
                placeholder: "جستجو کنید",
                language: {
                    inputTooShort: function() {
                        return "حداقل باید 3 حرف وارد کنید"
                    },
                    noResults: function() {
                        return "نتیجه ای یافت نشد";
                    },
                    searching: function() {
                        return "در حال جستجو...";
                    }
                },
                ajax: {
                    url: function(params) {
                        return window.ajaxUrl + "?type=" + $(this).data('type') + "&q=" + params.term;
                    },
                    dataType: 'json',
                    delay: 250,
                },
                minimumInputLength: 3
            });
            addProductOrder(select);
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>
@endsection