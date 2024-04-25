import "./pages/dashboard";
import "./create-fast-category";
import "./pages/slides";
import { PostCategoryTable, BlocksTable, PagesTable } from "./pages";

function postsTable() {
    let table;
    let dt = $("#posts_table").DataTable({
        info: false,
        columns: [
            { data: "checkbox" },
            { data: "title" },
            { data: "author" },
            { data: "categories" },
            { data: "tags" },
            { data: "comments" },
            { data: "created_at" },
        ],
        columnDefs: [
            {
                targets: 0,
                orderable: false,
            },
        ],
        order: [[6]],
        paging: false,
        searching: false,
        retrieve: true,
        destroy: true,
    });

    dt.draw();

    dt.on("draw", () => {
        initToggleToolbar();
        toggleToolbars();
    });

    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector("#posts_table");
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector(
            '[data-kt-docs-table-select="delete_selected"]'
        );

        // Toggle delete selected toolbar
        checkboxes.forEach((c) => {
            // Checkbox on click event
            c.addEventListener("click", function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
    };

    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector("#posts_table");
        const toolbarSelected = document.querySelector(
            '[data-kt-docs-table-toolbar="selected"]'
        );
        const selectedCount = document.querySelector(
            '[data-kt-docs-table-select="selected_count"]'
        );

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll(
            'tbody [type="checkbox"]'
        );

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;
        let checkedBoxes = [];

        // Count checked boxes
        allCheckboxes.forEach((c) => {
            if (c.checked) {
                checkedState = true;
                count++;
                $("#remove-items").val();
                // get data-id of checked checkboxes
                let id = c.getAttribute("data-id");
                checkedBoxes.push(id);
                $("#remove-items").val(checkedBoxes.join(","));
            }
        });

        // if count is same as total checkboxes then check table thead tr checkbox
        if (count == allCheckboxes.length) {
            $("thead [type='checkbox']").prop("checked", true);
        } else {
            $("thead [type='checkbox']").prop("checked", false);
        }

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarSelected.classList.remove("tw-invisible");
        } else {
            toolbarSelected.classList.add("tw-invisible");
            $("#remove-items").val("");
        }
    };
}

document.addEventListener("DOMContentLoaded", () => {
    // postsTable();
    // PostCategoryTable();
    // BlocksTable();
    // PagesTable();
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


