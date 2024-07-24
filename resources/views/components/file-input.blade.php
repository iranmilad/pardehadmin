<div>
    @if($type === "single")
        @if($preview === true)
        <div class="image-input image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
            <!--begin::نمایش existing avatar-->
            <div class="image-input-wrapper w-150px h-150px" @if($value !=="" ) style="background-image: url('{{ asset($value) }}')" @endif></div>

            <!--end::نمایش existing avatar-->
            <!--begin::Tags-->
            <button type="button" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow preview-image-label tw-absolute -tw-top-4 -tw-left-3" data-bs-toggle="tooltip" title="تعویض تصویر">
                <i class="ki-duotone ki-pencil fs-7">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--begin::Inputs-->
                <input type="hidden" name="{{$name}}" class="image_src" value="{{$value}}" />
                <!--end::Inputs-->
            </button>
            <!--end::Tags-->
            <!--begin::حذف-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow tw-absolute -tw-bottom-4 -tw-left-3 remove-image-input" data-bs-toggle="tooltip" title="">
                <i class="ki-duotone ki-cross fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <!--end::حذف-->
        </div>
        @else
        <div class="mt-3 mb-3">
            <div class="input-group choose_file_input">
                <input type="text" class="form-control" readonly name="{{$name}}" value="{{$value}}">
                <div class="input-group-append">
                    <button type="button" class="btn btn-success choose_file_button"><i class="fas fa-upload"></i></button>
                </div>
            </div>
        </div>

        @endif
    @else
        @if($preview === true)
        <div>
            <div class="tw-flex tw-gap-8 md:tw-gap-8 lg:tw-gap-7 tw-flex-wrap multiple_image_input">
                @if($value)
                @php
                $value = array_values($value);
                @endphp
                @foreach($value as $index => $new_value)
                <div class="image-input image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                    <!--begin::نمایش existing avatar-->
                    <div class="image-input-wrapper w-100px h-100px" @if($new_value !=="" ) style="background-image: url('{{ asset($new_value) }}')" @endif></div>

                    <!--end::نمایش existing avatar-->
                    <!--begin::Tags-->
                    <button type="button" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow preview-image-label tw-absolute -tw-top-4 -tw-left-3" data-bs-toggle="tooltip" title="تعویض تصویر">
                        <i class="ki-duotone ki-pencil fs-7">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <!--begin::Inputs-->
                        <input type="hidden" name="{{$name}}[{{$index}}]" class="image_src" value="{{ is_array($new_value) ? $new_value[0] : $new_value }}" />
                        <!--end::Inputs-->
                    </button>
                    <!--end::Tags-->
                    <!--begin::حذف-->
                    <button type="button" data-remove-full="true" data-preview="true" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow tw-absolute -tw-bottom-4 -tw-left-3 remove-image-input" data-bs-toggle="tooltip" title="">
                        <i class="ki-duotone ki-cross fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <!--end::حذف-->
                </div>
                @endforeach
                @endif
            </div>
            <div class="text-right w-100 d-flex align-items-center tw-justify-start mt-3">
                <button type="button" class="btn btn-sm btn-primary" data-add-multiple-type="preview" data-name="{{$name}}">افزودن</button>
            </div>
        </div>
        @else
            <div>
                <div class="multiple_image_input">
                    @if($value)
                        @php
                            $value = array_values($value);
                        @endphp
                        @foreach($value as $index => $new_value)
                        <div class="mb-3">
                            <div class="d-flex align-items-center choose_file_input">
                                <span class="remove-image-input" data-remove-full="true" data-preview="false"><i class="fa-regular fa-xmark text-danger me-3 fs-5"></i></span>
                                <input type="text" class="form-control image_src" readonly disabled value="{{is_array($new_value) ? $new_value[0] : $new_value}}" name="{{$name}}[{{$index}}]">
                            </div>
                            <div class="d-flex tw-justify-end tw-w-full">
                                <button type="button" class="btn p-0 text-info choose_file_button">آپلود</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-primary"  data-add-multiple-type="nopreview" data-name="{{$name}}">افزودن</button>
                </div>
            </div>
        @endif
    @endif
</div>
