import "./pages/dashboard";
// import "./create-fast-category";
import { PostCategoryTable, BlocksTable, PagesTable,UsersTable ,AttributesTable,PostsTable} from "./pages";
import "./pages/attribute";


document.addEventListener("DOMContentLoaded", () => {
    KTUtil.onDOMContentLoaded(function () {
        PostsTable();
        PostCategoryTable();
        BlocksTable();
        PagesTable();
        UsersTable();
        AttributesTable().init();
    });

});

if ($("#editor").length > 0) {
    ClassicEditor.create(document.querySelector("#editor"), {
        // Editor configuration.
    })
        .then((editor) => {
            window.editor = editor;
        })
        .catch();
}

// intermidiate checkbox
export function intermidiateCheckbox() {
    if ($(".intermediat-checkbox").length > 0) {
        $('input[type="checkbox"]').change(function (e) {
            var checked = $(this).prop("checked"),
                container = $(this).closest("li"), // Use closest() to find the parent li element
                siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked,
            });

            function checkSiblings(el) {
                var parent = el.parent().closest("li"), // Find the closest parent li element
                    all = true;

                el.siblings().each(function () {
                    let returnValue = (all =
                        $(this)
                            .children('input[type="checkbox"]')
                            .prop("checked") === checked);
                    return returnValue;
                });

                if (all && checked) {
                    parent.children('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked,
                    });

                    checkSiblings(parent);
                } else if (all && !checked) {
                    parent
                        .children('input[type="checkbox"]')
                        .prop("checked", checked);
                    parent
                        .children('input[type="checkbox"]')
                        .prop(
                            "indeterminate",
                            parent.find('input[type="checkbox"]:checked')
                                .length > 0
                        );
                    checkSiblings(parent);
                } else {
                    el.parents("li").children('input[type="checkbox"]').prop({
                        indeterminate: true,
                        checked: false,
                    });
                }
            }

            checkSiblings(container);
        });
    }
}

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
    if(copyText.val() == ""){
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

$(document).ready(function(){
    let firstClick = false;
    $("#wide-container-changer").on("click",(e) => {
        $("#kt_app_content_container").toggleClass("container-xxl");
        if(!$("#kt_app_content_container").hasClass("container-xxl")){
            $(e.target).text("حالت عادی")
        }
        else{
            $(e.target).text("حالت عریض")
        }
    })
    
})