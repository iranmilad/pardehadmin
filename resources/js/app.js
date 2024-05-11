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
    OrdersTable
} from "./pages";
// import "./pages/attribute";
// import "./create-fast-category";
import { intermidiateCheckbox } from "./globals";
import { hydrate, createElement } from "preact";
import "jquery-validation";
import "./pages/message";

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

$(document).on("DOMContentLoaded", () => {
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

if($("#create_coupon_code").length > 0){
    let genLength = $("#create_coupon_code").data("length-generate");
    $("#create_coupon_code").on("click", function(){
        let code = generateCouponCode(genLength);
        $("#coupon_code").val(code);
    })
}