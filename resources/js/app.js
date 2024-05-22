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
} from "./pages";
// import "./pages/attribute";
// import "./create-fast-category";
import { intermidiateCheckbox } from "./globals";
import { hydrate, createElement } from "preact";
import "jquery-validation";
import "./pages/message";
import Sortable from "sortablejs";
import "./marker";

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
});

if ($(".editor").length > 0) {
    document.querySelectorAll(".editor").forEach((elm) => {
        ClassicEditor.create(elm, {
            // Editor configuration.
        })
            .then((editor) => {
                window.editor = editor;
            })
            .catch();
    });
}

// intermidiate checkbox
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

document.addEventListener("DOMContentLoaded", () => {
    generateSortable();
});

function generateSortable() {
    if (window["sortable"]) {
        window["sortable"].destroy();
    }
    let el = document.getElementById("menu_lists");
    let sortable = (window["sortable"] = Sortable.create(el, {
        animation: 150,
        group: "shared",
        handle: null,
        swapThreshold: 0.3,
        onSort: (evt)=>{
            let childrens = $(el.children);
            childrens.each( (index,item) => {
                let title = $(item).children(".accordion").find("input[type='text']");
                let url = $(item).children(".accordion").find("input[type='url']");
                title.attr('name',`[${index}]['title']`);
                url.attr('name',`[${index}]['title']`);
                if($(item).children(".nested-list").children().length > 0){
                    
                }
            })
        },
        onUpdate: function (evt) {
            // Find all direct children of the main list
            var children = el.children;
            // Loop through each child div
            for (var i = 0; i < children.length; i++) {
                var child = children[i];

                // Check if the child does not already contain a nested list
                if (!child.querySelector(".nested-list")) {
                    // Create a new div with class 'nested-list'
                    var nestedList = document.createElement("div");
                    nestedList.classList.add("nested-list");

                    // Append the nested list to the child
                    child.appendChild(nestedList);

                    // Initialize Sortable.js on the new nested list
                    Sortable.create(nestedList, {
                        animation: 150,
                        group: "shared",
                        handle: null,
                        swapThreshold: 0,
                    });
                }
            }
        },
    }));
    var children = el.children;
    // Loop through each child div
    for (var i = 0; i < children.length; i++) {
        var child = children[i];

        // Check if the child does not already contain a nested list
        if (!child.querySelector(".nested-list")) {
            // Create a new div with class 'nested-list'
            var nestedList = document.createElement("div");
            nestedList.classList.add("nested-list");

            // Append the nested list to the child
            child.appendChild(nestedList);

            // Initialize Sortable.js on the new nested list
            Sortable.create(nestedList, {
                animation: 150,
                group: "shared",
                handle: null,
            });
        }
    }
    let nestedItems = document.querySelectorAll(".nested-list");
    nestedItems.forEach((item) => {
        Sortable.create(item, {
            animation: 150,
            group: "shared",
            handle: null,
        });
    });
    return sortable;
}

$(".custom-link-gen").on("click", function () {
    let title = $(this).parent().find(".custom-link-title").val();
    let link = $(this).parent().find(".custom-link-link").val();
    let parent = generateCouponCode(12);
    let sub = generateCouponCode(12);
    addAccordionItem(sub, title, link);
    $(this).parent().find(".custom-link-title").val("");
    $(this).parent().find(".custom-link-link").val("");
});

function addAccordionItem(subId, title, link) {
    const uniqueId = `accordion-${Date.now()}`;
    const accordionHtml = `
        <div>
            <div class="accordion" id="${uniqueId}">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${subId}" aria-expanded="false" aria-controls="${subId}">
                            ${title}
                        </button>
                    </h2>
                    <div id="${subId}" class="accordion-collapse collapse" data-bs-parent="#${uniqueId}">
                        <div class="accordion-body">
                            <div class="mb-5">
                                <label for="" class="form-label">عنوان</label>
                                <input type="text" class="form-control" value="${title}">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">لینک</label>
                                <input type="url" class="form-control" value="${link}" placeholder="https://example.com">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nested-list">
                <!-- Your nested div content here -->
            </div>
        </div>
    `;

    const $accordion = $(accordionHtml);

    // Create the remove button
    var $removeButton = $("<button>", {
        text: "حذف",
        class: "btn btn-sm btn-danger",
        type: "button",
        click: function (e) {
            e.preventDefault();
            $(this)
                .closest(".accordion").parent()
                .slideUp(400, function () {
                    $(this).remove();
                });
        },
    });

    // Append the remove button to the accordion body
    $accordion.find(".accordion-body").append($removeButton);

    // Append the accordion to the menu list
    $("#menu_lists").append($accordion);

    generateSortable();
}

$(".accordion-item .remove-accordion").on("click", function (e) {
    e.preventDefault();
    $(this)
        .closest(".accordion")
        .slideUp(400, function () {
            $(this).remove();
        });
});

$("#menu-form").on("submit", function (e) {
    e.preventDefault();
});

$(".other_items_menu").on("click", function (e) {
    let checkboxes = $(this)
        .closest(".accordion")
        .find("input[type='checkbox']:checked");
    if (checkboxes.length > 0) {
        checkboxes.each((index, item) => {
            let title = $(item).data("title");
            let link = $(item).data("link");
            let sub = generateCouponCode(12);
            addAccordionItem(sub, title, link);
            $(item).prop("checked", false);
        });
    }
});
