<div>
    @if($type === "single")
    @if($preview === true)
    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
        <!--begin::نمایش existing avatar-->
        <div class="image-input-wrapper w-150px h-150px" style="background-image: url(http://localhost/uploads/2021-Bugatti-Chiron-Pur-Sport-011-2160.jpg);"></div>
        <!--end::نمایش existing avatar-->
        <!--begin::Tags-->
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow preview-image-label" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
            <i class="ki-duotone ki-pencil fs-7">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <!--begin::Inputs-->
            <input type="hidden" name="{{$name}}" />
            <!--end::Inputs-->
        </label>
        <!--end::Tags-->
        <!--begin::انصراف-->
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف">
            <i class="ki-duotone ki-cross fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
        <!--end::انصراف-->
        <!--begin::حذف-->
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
            <i class="ki-duotone ki-cross fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
        <!--end::حذف-->
    </div>
    @else

    <div class="input-group choose_file_input">
        <input type="text" class="form-control" readonly disabled name="{{$name}}">
        <button class="btn btn-secondary choose_file_button" type="button">انتخاب فایل</button>
    </div>
    @endif
    @else
    @endif
</div>