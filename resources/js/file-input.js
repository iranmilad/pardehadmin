export function KT_File_Input() {
    window["choose_file"] = null;
    $(
        ".choose_file_button,.image-input .preview-image-label,button[data-add-multiple-type='preview'],button[data-add-multiple-type='nopreview']"
    ).on("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        window["choose_file"] = e.target;

        window.open("/file-manager/fm-button", "fm", "width=1400,height=800");
    });

    $(".remove-image-input").on("click", function () {
        if ($(this).data("remove-full") === true) {
            if($(this).data("preview") === true){
                let parent = $(this).parent().parent();
                $(this).parent().remove();
                resortFieldsNames(parent);
            }
            else{
                let parent = $(this).parent().parent().parent();
                console.log(parent)
                $(this).parent().parent().remove();
                resortFieldsNames(parent);
            }
        } else {
            $(this)
                .parent()
                .find(".image-input-wrapper")
                .css("background-image", "");
            $(this).css("display", "none");
            $(this).parent().find(".image_src").val("");
        }
    });

    $(".image-input").each(function () {
        if ($(this).find(".image_src").val() === "") {
            $(this).find(".remove-image-input").css("display", "none");
        } else {
            $(this).find(".remove-image-input").css("display", "block");
        }
    });

    window["changethatBg"] = function (elm, url) {
        elm.style.backgroundImage = `url(${url})`;

        elm.closest(".image-input").querySelector(".image_src").value = url;

        const removeButton = elm
            .closest(".image-input")
            .querySelector(".remove-image-input");
        if (removeButton) {
            removeButton.style.display = "block";
        }
    };

    window['preview_multi'] = function(elm, url) {
        if(elm.getAttribute("data-add-multiple-type") === "preview"){
            let index = elm.parentElement.parentElement.querySelectorAll('.image_src').length;
            const name = elm.getAttribute("data-name");
            let new_elm = `
                <div class="image-input image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                    <!--begin::نمایش existing avatar-->
                    <div class="image-input-wrapper w-100px h-100px" style="background-image: url(${url})"></div>
                    <!--end::نمایش existing avatar-->
                    <!--begin::Tags-->
                    <button type="button" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow preview-image-label tw-absolute -tw-top-4 -tw-left-3" data-bs-toggle="tooltip" title="تعویض تصویر">
                        <i class="ki-duotone ki-pencil fs-7">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <!--begin::Inputs-->
                        <input type="hidden" name="${name}[${index}]" class="image_src" value="${url}" />
                        <!--end::Inputs-->
                    </button>
                    <!--end::Tags-->
                    <!--begin::حذف-->
                    <button type="button" data-remove-full="true" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow tw-absolute -tw-bottom-4 -tw-left-3 remove-image-input" data-bs-toggle="tooltip" title="">
                        <i class="ki-duotone ki-cross fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <!--end::حذف-->
                </div>`;
            elm.parentElement.parentElement.querySelector('.multiple_image_input').insertAdjacentHTML('beforeend', new_elm);
            window['KT_File_Input']();
        }
        else{
            let index = elm.parentElement.parentElement.querySelectorAll('.image_src').length;
            console.log(index)
            const name = elm.getAttribute("data-name");
            let new_elm = `
                <div class="mb-3">
                    <div class="d-flex align-items-center choose_file_input">
                        <span class="remove-image-input" data-remove-full="true" data-preview="false"><i class="fa-regular fa-xmark text-danger me-3 fs-5"></i></span>
                        <input type="text" class="form-control image_src" readonly disabled value="${url}" name="${name}[${index}]">
                    </div>
                    <div class="d-flex tw-justify-end tw-w-full">
                        <button class="btn p-0 text-info choose_file_button">آپلود</button>
                    </div>
                </div>`;
                elm.parentElement.parentElement.querySelector('.multiple_image_input').insertAdjacentHTML('beforeend', new_elm);
                window['KT_File_Input']();
        }
    }    

}

function resortFieldsNames(elm) {
    $(elm)
        .find(".image_src")
        .each(function (index) {
            let item = $(this);
            let name = item.attr("name");
            name = name.replace(/[0-9]/g, "").replace("[]", "");
            item.attr("name", `${name}[${index}]`);
        });
}