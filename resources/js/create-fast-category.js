import $ from "jquery";
import "jquery-validation";
import { intermidiateCheckbox } from "./app";

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
