@extends('layouts.primary')

@section('title', 'مدیریت کارها')

@section('css')
<link rel="stylesheet" href="{{asset('plugins/custom/jkanban/jkanban.bundle.css')}}">
<link rel="stylesheet" href="{{asset('plugins/custom/jkanban/jkanban.bundle.rtl.css')}}">
@endsection

@section("toolbar")
<div>
    <button class="btn btn-primary" type="button" id="addNewTask">افزودن کار</button>
    <button class="btn btn-info" type="button" id="addNewBoardModal">افزودن وضعیت</button>
</div>
@endsection


@section('content')
<div id="kanban"></div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش کار</h1>
                <button type="button" class="btn-close close_edit_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">عنوان :</label>
                    <input type="text" placeholder="عنوان را وارد کنید" class="form-control" id="editModalTitle">
                </div>

                <div class="mb-3">
                    <label for="message-text" class="col-form-label">وضعیت :</label>
                    <select class="form-select" name="" id="boards-status">
                        <option value="nkjkln56342">شروع نشده</option>
                        <option value="sb7df9asd">در حال انجام</option>
                        <option value="fdgmndfg2">اتمام یافته</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="message-text" class="col-form-label">تاریخ شروع :</label>
                    <input class="form-control date_picker" id="startDate" type="text" data-jdp>
                </div>

                <div class="mb-3">
                    <label for="message-text" class="col-form-label">تاریخ پایان :</label>
                    <input class="form-control date_picker" id="endDate" type="text" data-jdp>
                </div>

                <div class="mb-3">
                    <label for="message-text" class="col-form-label">انجام دهنده :</label>
                    <x-advanced-search type="user" label="" name="user" single />
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <button type="submit" class="btn btn-success" id="save_edit_modal">ذخیره</button>
                <button class="btn btn-danger" type="button" id="removeKanbanItem">حذف</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="boardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش تخته</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">عنوان :</label>
                    <input type="text" id="boardTitle" placeholder="عنوان را وارد کنید" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="message-text" class="col-form-label">رنگ :</label>
                    <input type="hidden" id="boardColor" value="#AB0000">
                    <div class="color-picker"></div>
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <button type="button" id="addNewBoard" class="btn btn-success">افزودن</button>
                <button class="btn btn-danger" type="button" id="removeKanban">حذف</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section("script-before")
<script src="{{asset('plugins/custom/jkanban/jkanban.bundle.js')}}"></script>
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
<script src="{{asset('plugins/custom/pickr/pickr.es5.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    jalaliDatepicker.startWatch();
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize color picker
        $(".color-picker").each(function(i) {
            const elm = $(this);
            const parent = $(this).prev('input');
            const pickerConfig = {
                el: this,
                theme: 'nano', // or 'monolith', or 'nano'
                default: $(this).prev('input').val(),
                swatches: [
                    'rgba(171, 0, 0, 1)',
                    'rgba(63, 81, 181, 1)',
                    'rgba(33, 150, 243,1)',
                    'rgba(0, 150, 136,1)',
                    'rgba(76, 175, 80,1)',
                    'rgba(255, 235, 59,1)',
                    'rgba(107, 114, 128)'

                ],
                components: {
                    preview: false,
                    opacity: false,
                    hue: false,
                    interaction: {
                        hex: true,
                        input: true,
                        clear: true,
                        cancel: true,
                        save: true
                    }
                },
                i18n: {
                    'btn:save': 'ذخیره',
                    'btn:cancel': 'انصراف',
                    'btn:clear': 'پاک کردن',
                }
            }

            let colorpicker = window['boardColor'] = new Pickr(pickerConfig);
            colorpicker.on("save", (color, instance) => {
                $(this).val(color.toHEXA().toString())
                parent.val(color.toHEXA().toString())
                instance.hide();
            });
        });
    })
</script>
@endsection