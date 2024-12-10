<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ایجاد سفارش')


@section('content')

<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div class="card mb-10">
        <div class="card-header">
            <div class="card-title">
                <h4>جزئیات سفارش</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <div class="mb-5">
                        <label class="form-label" for="">تاریخ و زمان ایجاد</label>
                        <input class="form-control form-control-solid" type="text" data-jdp name="created_at">
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-5">
                        <label class="form-label" for="">وضعیت</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="status" id="status">
                            <option value="basket">در سبد مشتری</option>
                            <option value="pending">در انتظار بررسی</option>
                            <option value="processing">درحال بررسی</option>
                            <option value="complete">انجام شده</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-5">
                        <x-advanced-search type="user" label="مشتری" name="user" solid />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <button class="btn btn-success" type="submit">ذخیره</button>
    </div>
</form>

@endsection

@section("script-before")
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    jalaliDatepicker.startWatch({
        time: true,
        hasSecond: false
    });

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
        ready: function(){
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
