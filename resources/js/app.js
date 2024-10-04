import $ from "jquery";
import "jquery-validation";
import "./pages/dashboard";
import {
    PostCategoryTable,
    BlocksTable,
    PagesTable,
    UsersTable,
    AttributesTable,
    PostsTable,
    ProductCategoriesTable,
    ProductTagsTable,
    ProductCommentsTable,
    ProductsTable,
    MessagesTable,
    ChecksTable,
    DiscountsTable,
    OrdersTable,
    PostCommentsTable,
    InstallmentsTable,
    InstallmentsPlansTable,
    WorktimesTable,
    ImageMarkersTable,
    SnippetsTable,
    ReportsTable,
    GlobalTable,
    CustomerGroupTable,
} from "./pages";
// import "./pages/attribute";
// import "./create-fast-category";
import { intermidiateCheckbox } from "./globals";
import { hydrate, createElement } from "preact";
import "jquery-validation";
import "./pages/message";
import "./marker";
import "./menu";
import Sortable, { Swap } from "sortablejs";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import markerIcon from "../images/marker-icon.svg";
import "./messages-dashboard";
import "./file-uploader";
import { KT_File_Input } from "./file-input";
import "./ckeditor/bundle";
import "./form";

KTUtil.onDOMContentLoaded(function () {
    PostsTable()?.init();
    PostCategoryTable()?.init();
    BlocksTable()?.init();
    PagesTable()?.init();
    UsersTable()?.init();
    AttributesTable()?.init();
    ProductCategoriesTable()?.init();
    ProductTagsTable()?.init();
    ProductCommentsTable()?.init();
    ProductsTable()?.init();
    MessagesTable()?.init();
    ChecksTable()?.init();
    DiscountsTable()?.init();
    OrdersTable()?.init();
    PostCommentsTable()?.init();
    InstallmentsTable()?.init();
    InstallmentsPlansTable()?.init();
    WorktimesTable()?.init();
    ImageMarkersTable()?.init();
    SnippetsTable()?.init();
    ReportsTable()?.init();
    GlobalTable()?.init();
    CustomerGroupTable()?.init();
    KT_File_Input();
});

window["KT_File_Input"] = KT_File_Input;
if ($("#shortCodeListModal").length > 0) {
    window["shortCodeListModal"] = new bootstrap.Modal("#shortCodeListModal", {
        keyboard: false,
    });
}

// intermidiate checkbox
$(document).ready(function () {
    intermidiateCheckbox();
});
var input = document.querySelector("#post-type-tags");

// Initialize Tagify script on the above inputs
let post_types_tags = new Tagify(input, {
    dropdown: {
        // <- mixumum allowed rendered suggestions
        enabled: 0, // <- show suggestions on focus
        closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
        pattern: /^.{1,70}/,
    },
});

function generatePassword() {
    var length = 8,
        charset =
            "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

// create password .create-password-input-group
$(".create-password-input-group-generate").on("click", function () {
    var password = generatePassword();
    $(this).parent().find("input").val(password);
});

$(".create-password-input-group-copy").on("click", function () {
    let copyText = $(this).parent().find("input");
    if (copyText.val() == "") {
        return;
    }
    copyText.select();
    document.execCommand("copy");
    // remove btn-dark and add btn-success for 2 seconds. after 2 seconds revert back to btn-dark
    $(this).removeClass("btn-dark").addClass("btn-success");
    setTimeout(() => {
        $(this).removeClass("btn-success").addClass("btn-dark");
    }, 2000);
});

$(document).ready(function () {
    let firstClick = false;
    $("#wide-container-changer").on("click", (e) => {
        $("#kt_app_content_container").toggleClass("container-xxl");
        if (!$("#kt_app_content_container").hasClass("container-xxl")) {
            $(e.target).text("حالت عادی");
        } else {
            $(e.target).text("حالت عریض");
        }
    });
});

// Add custom method to jQuery validation
$.validator.addMethod(
    "englishOnly",
    function (value, element) {
        // Regular expression to match English characters only
        return /^[a-zA-Z0-9-_]*$/.test(value);
    },
    "به انگلیسی وارد کنید"
);

const validationPlaces = {
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        element.next(".invalid-feedback,.error").remove();
        error.insertAfter(element);
    },
    errorClass: "is-invalid",
    highlight: function (element, errorClass, validClass) {
        $(element).addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass(errorClass).addClass(validClass);
    },
};

let crateFastCat = $("#categoryCreateFast").validate({
    rules: {
        title: {
            required: true,
        },
        slug: {
            required: true,
            englishOnly: true,
        },
    },
    messages: {
        title: {
            required: "لطفا عنوان را وارد کنید",
        },
        slug: {
            required: "لطفا نامک را وارد کنید",
            englishOnly: "لطفا نامک را به انگلیسی وارد کنید",
        },
    },
    ...validationPlaces,
});

$("#categoryCreateFast").on("submit", (e) => {
    e.preventDefault();
    if (crateFastCat.valid()) {
        let title = $("#categoryCreateFast [name='title']").val().trim();
        let slug = $("#categoryCreateFast [name='slug']").val().trim();
        let parent = $("#categoryCreateFast [name='parent']").val().trim();
        if (parent === "mother") {
            $(".category-list").append(`
                <li>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="${slug}" name="${slug}" />
                        <label class="form-check-label" for="${slug}">
                            ${title}
                        </label>
                    </div>
                    <ul></ul>
                </li>
                `);
            $("#categoryCreateFast [name='parent']").append(
                `<option value="${slug}">${title}</option>`
            );
        } else {
            let newParent = $(`.category-list [name="${parent}"]`)
                .parent()
                .parent()
                .children("ul");
            newParent.append(`
                <li>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="${slug}" name="${parent}[${slug}]" />
                        <label class="form-check-label" for="${slug}">
                            ${title}
                        </label>
                    </div>
                </li>
                `);
        }

        $("#categoryCreateFast :is([name='title'],[name='slug'])").val("");
        $("#categoryCreateFast [name='parent']").val("mother");
        intermidiateCheckbox();
    }
});

// generate coupen code
function generateCouponCode(length) {
    let letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let code = "";
    for (let i = 0; i <= length; i++) {
        code += letters.charAt(Math.floor(Math.random() * letters.length));
    }
    return code;
}

if ($("#create_coupon_code").length > 0) {
    let genLength = $("#create_coupon_code").data("length-generate");
    $("#create_coupon_code").on("click", function () {
        let code = generateCouponCode(genLength);
        $("#coupon_code").val(code);
    });
}

const exampleModal = document.getElementById("replyModal");
if (exampleModal) {
    exampleModal.addEventListener("show.bs.modal", (event) => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute("data-bs-whatever");
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = exampleModal.querySelector(".modal-title");
        const modalBodyInput = exampleModal.querySelector(".modal-body input");

        modalTitle.textContent = `پاسخ به ${recipient}`;
        modalBodyInput.value = recipient;
    });
}

$("#product_table_table tbody tr button[data-bs-toggle]").on(
    "click",
    function () {
        $("#replyModal [name='message-id']").val($(this).data("id"));
    }
);

$(".editOptionsToggleOrder").on("click", function () {
    let parent = $(this).parent().parent();
    // find input and select and toggle disabled
    parent.find("input,select").prop("disabled", function (i, v) {
        return !v;
    });

    // toggle button text based on data-clicked. if its false say save else say edit
    if ($(this).data("clicked") === false) {
        $(this).text("لغو").removeClass("btn-secondary").addClass("btn-danger");
        $(this).data("clicked", true);
    } else {
        $(this)
            .text("ویرایش")
            .removeClass("btn-danger")
            .addClass("btn-secondary");
        $(this).data("clicked", false);
    }
});

// Stepper lement
if ($("#kt_stepper_example_clickable").length > 0) {
    var element = document.querySelector("#kt_stepper_example_clickable");

    // Initialize Stepper
    var stepper = new KTStepper(element);

    // Handle navigation click
    stepper.on("kt.stepper.click", function (stepper) {
        stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step
    });

    // Handle next step
    stepper.on("kt.stepper.next", function (stepper) {
        stepper.goNext(); // go next step
    });

    // Handle previous step
    stepper.on("kt.stepper.previous", function (stepper) {
        stepper.goPrevious(); // go previous step
    });
}

document.addEventListener("DOMContentLoaded", function () {
    let el = document.getElementById("product_tabs_sortable");
    let sortable = Sortable.create(el, {
        animation: 150,
        group: "shared",
        handle: null,
        swapThreshold: 0.3,
    });
});

$("[data-kt-image-input-gallery-action='remove']").on("click", function () {
    let parent = $(this).parent();
    parent.remove();
});

if ($(".global_tag").length > 0) {
    let globalTag = new Tagify($(".global_tag").get(0), {
        whitelist: [],
        dropdown: {
            maxItems: 20, // <- mixumum allowed rendered suggestions
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
            pattern: /^.{1,70}/,
        },
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Create a map centered at a specific location
    if (document.getElementById("map")) {
        var mymap = L.map("map").setView(
            [35.70222474889245, 51.338657483464765],
            13
        );

        // Add a tile layer (OpenStreetMap tiles)
        L.tileLayer(
            "http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}&BBOX=25.0,35.0,42.0,40.0",
            {
                attribution: "",
                subdomains: ["mt0", "mt1", "mt2", "mt3"],
            }
        ).addTo(mymap);
        mymap.on("click", function (e) {
            let lat = e.latlng.lat;
            let lng = e.latlng.lng;
            $("#location-map").val(`${lat},${lng}`);
            updateMarkers();
        });

        var customIcon = L.icon({
            iconUrl: markerIcon, // Set the path to your custom icon image
            iconSize: [32, 32], // Set the size of the icon
            iconAnchor: [16, 32], // Set the anchor point of the icon (centered, bottom point in this case)
            popupAnchor: [0, -32], // Set the popup anchor relative to the icon
        });

        // Create a layer group to store markers
        var markerLayer = L.layerGroup().addTo(mymap);

        function updateMarkers() {
            // Clear existing markers
            markerLayer.clearLayers();

            // Get new location
            let marks = $("#location-map").val();
            marks = marks.split(",");
            marks = marks.map((mark) => parseFloat(mark));

            // Add new marker
            L.marker(marks)
                .addTo(markerLayer)
                .bindPopup("آدرس")
                .openPopup()
                .setIcon(customIcon);
        }

        // Call updateMarkers function initially or whenever you need to update the marker
        updateMarkers();

        // Optionally, attach updateMarkers to an event listener if you want to update markers based on an event
        // Example: if there's a dropdown for selecting locations
        // $('#location-map').on('change', updateMarkers);
    }
});

Sortable.mount(new Swap());

document.addEventListener("DOMContentLoaded", () => {
    let elm = document.querySelectorAll(".swapSortable");
    elm.forEach((item) => {
        new Sortable(item, {
            swap: true, // Enable swap plugin
            swapClass: "highlight", // The class applied to the hovered swap item
            animation: 150,
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    let elm = document.querySelectorAll(".indexSortable");
    elm.forEach((item) => {
        window['indexSortable'] = new Sortable(item, {
            swap: true, // Enable swap plugin
            swapClass: "highlight", // The class applied to the hovered swap item
            animation: 150,
            disabled: true,
            onEnd: function(evt) {
                // شیء جدید برای نگهداری مقادیر مرتب‌شده
                var sortedData = {'index_sort': []};
                let sortValue = [];
                // دریافت ورودی‌های مخفی مرتب‌شده
                var hiddenInputs = $(evt.to).find('input[type="hidden"]');
                
                hiddenInputs.each(function(index, element) {
                    // گرفتن نام و مقدار هر ورودی
                    var inputName = $(element).attr('name');
                    var inputValue = $(element).val();
        
                    // قرار دادن نام و مقدار در شیء sortedData
                    sortValue.push(inputValue);
                });
                sortedData.index_sort = sortValue;
        
                // تبدیل شیء به رشته JSON و قرار دادن در فیلد مخفی
                $('#indexSortableValue').val(JSON.stringify(sortedData));
        
                // نمایش شیء مرتب‌شده در کنسول
                console.log(sortedData);
            }
        });
    });
});

$(document).ready(function() {
    // وقتی روی دکمه مرتب کردن کلیک شد
    $('#sortButton').on('click', function() {
        // دکمه مرتب کردن را مخفی کن
        $(this).hide();
        window['indexSortable'].option("disabled", false);
        // دکمه‌های ذخیره و لغو را نمایش بده
        $('#actionButtons').removeClass('d-none').addClass('d-flex');
        $(".indexSortable").addClass('active')
    });
});

// document.addEventListener("DOMContentLoaded" ,() => {
//     if($("#add_service_modal").length > 0){
//         let service_modal = new bootstrap.Modal("#add_service_modal" , {
//             focus: false
//         })
//         $("#show_add_service_modal").on("click" , () => {
//             service_modal.show()
//         })
//     }
// })
