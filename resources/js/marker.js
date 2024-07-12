/**
 * MARKER PAGE
 */

if ($("#selectProductModal").length > 0) {
    var imageMarkerModal = new bootstrap.Modal("#selectProductModal", {
        focus: false,
    });

    var productInfoModal = new bootstrap.Modal("#priceModal", {
        focus: false,
    });
}
var percentX = 0;
var percentY = 0;

if ($("#imgmarker-preview").length > 0) {
    document
        .getElementById("imgmarker-preview")
        .addEventListener("click", function (event) {
            const img = event.target;
            const rect = img.getBoundingClientRect();
            var IMGX = event.clientX - rect.left - 9;
            var IMGY = event.clientY - rect.top - 8;

            // Calculate the width and height of the image
            const imgWidth = rect.width;
            const imgHeight = rect.height;

            // Convert the X and Y coordinates to percentages
            percentX = (IMGX / imgWidth) * 100;
            percentY = (IMGY / imgHeight) * 100;

            imageMarkerModal.show();
            if (selectType === "") {
                $("#removeSelectDot").addClass("d-none");
            } else {
                $("#removeSelectDot").removeClass("d-none");
            }
        });
}

if ($("#selectProductModal").length > 0) {
    document
        .getElementById("selectProductModal")
        .addEventListener("hidden.bs.modal", () => {
            selectType = "";
        });
}

document.addEventListener("DOMContentLoaded", () => {
    selectType = "";
});

$("#selectProductModalSubmit").on("click", function (e) {
    let productName = $("#selectProductModal .modal-body form select")
        .find(":selected")
        .text();
    let productID = $("#selectProductModal .modal-body form select")
        .find(":selected")
        .val();
    if (selectType === "change") {
        percentY = selectedDot.position().top;
        percentX = selectedDot.position().left;

        percentY = (percentY / selectedDot.parent().height()) * 100;
        percentX = (percentX / selectedDot.parent().width()) * 100;

        selectedDot.remove();
    }
    createMarks(percentY, percentX, productID, productName);
    $("#selectProductModal .modal-body form select").val("");
    setTimeout(() => {
        updateInputMarks();
    }, 50);
    imageMarkerModal.hide();
});

function createMarks(percentY, percentX, productID, productName, productLink) {
    let elm = $("<span>", {
        style: `top: ${percentY}%; left: ${percentX}%;`,
        "data-id": productID,
        "data-bs-toggle": "tooltip",
        "data-bs-title": productName,
        "data-link": productLink,
        click: changeImageMarker,
    });
    $(".image_dotter").append(elm);
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
}

let productDetailBlock = new KTBlockUI(
    document.querySelector("#priceModal .product_details"),
    {
        overlayClass: "tw-bg-transparent",
    }
);

let selectedDot = null;
var selectType = "";
function changeImageMarker(e) {
    let id = $(this).data("id");
    let link = $(this).data("link");
    $.ajax({
        url: `/api/imgdot/${id}`,
        beforeSend: function () {
            $("#priceModal .product_details").html("");
            productInfoModal.show();
            productDetailBlock.block();
        },
        success: function (result) {
            $("#priceModal .product_details").html(result.html);
            $("#priceModal .modal-footer a").attr("href", link);
            $("#priceModal .modal-footer a").attr("target", "_blank");
            productDetailBlock.release();
        },
    });
    selectType = "change";
    $("#removeSelectDot").removeClass("d-none");
    selectedDot = $(this);
}

$("#removeSelectDot").on("click", function () {
    selectedDot.remove();
    selectedDot = null;
    imageMarkerModal.hide();
    selectType = "";
    $(this).addClass("d-none");
});

$("#choose_image").on("change", function (event) {
    const file = event.target.files[0];
    const imgPreview = document.getElementById("imgmarker-preview");

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = "block"; // Show the image
        };

        reader.readAsDataURL(file); // Read the file as a data URL
        $(".image_dotter span").remove();
    } else {
        imgPreview.src = "";
        imgPreview.style.display = "none"; // Hide the image if no file is selected
    }
});

$("#remove_image").on("click", function (e) {
    $("#choose_image").val("");
    $("#imgmarker-preview").attr("src", "");
    $(".image_dotter span").remove();
    updateInputMarks();
});

$("#editDot").on("click", () => {
    productInfoModal.hide();
    imageMarkerModal.show();
});

/**
 * with this function i update input[name="marks"] in form
 * @page imagemarker.blade.php
 */
function updateInputMarks() {
    let spans = [];
    $(".image_dotter span").each(function (index, item) {
        let $item = $(item);
        let percentY2 = $item.position().top;
        let percentX2 = $item.position().left;
        let dataId = $item.attr("data-id");
        let productName = $item.attr("data-bs-title");
        percentY2 = (percentY2 / $item.parent().height()) * 100;
        percentX2 = (percentX2 / $item.parent().width()) * 100;

        spans.push({
            top: percentY2,
            left: percentX2,
            dataId: dataId,
            productName,
        });
    });

    $("#data-dots").val(JSON.stringify(spans));
}

$(document).ready(function () {
    if ($("#data-dots").length > 0) {
        let markerId = $('input[name="marks_id"]').val();
        if (markerId !== "") {
            let blockUI = new KTBlockUI(document.getElementById("kt_app_main"));
            $.ajax({
                url: `/api/checkproduct/${markerId}`,
                method: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                beforeSend: () => blockUI.block(),
                success: (response) => {
                    let res = response;
                    if (res.length > 0) {
                        res.map((item) => {
                            createMarks(
                                item.top,
                                item.left,
                                item.dataId,
                                item.productName,
                                item.link
                            );
                        });
                    }
                    blockUI.release();
                },
                error: () => blockUI.release(),
            });
        }
    }
});
