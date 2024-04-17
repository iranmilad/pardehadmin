import "./pages/dashboard";
import "./create-fast-category";

// function postsTable() {
//     let tablex = new DataTable("#posts_table",{
//         info: false,
//         columns: [
//             { data: "checkbox" },
//             { data: "title" },
//             { data: "author" },
//             { data: "categories" },
//             { data: "tags" },
//             { data: "comments" },
//             { data: "created_at" },
//         ],
//         order: [[6]],
//         columnDefs: [
//             {
//                 targets: 0,
//                 orderable: false,
//                 render: function (data, type, row, meta) {
//                     return `
//                         <div class="form-check form-check-sm form-check-custom form-check-solid">
//                             <input class="form-check-input" type="checkbox" value="${data}" data-row="${meta.row}" data-real-id="${row.id}" />
//                         </div>`;
//                 },
//             },
//         ],
//         paging: false,
//     });

//     tablex.on("draw", function () {
//         console.log('draw')
//     });

//     var initToggleToolbar = function () {
//         // Toggle selected action toolbar
//         // Select all checkboxes
//         const container = document.querySelector("#kt_datatable_example_1");
//         const checkboxes = container.querySelectorAll('[type="checkbox"]');

//         // Select elements
//         const deleteSelected = document.querySelector(
//             '[data-kt-docs-table-select="delete_selected"]'
//         );

//         // Toggle delete selected toolbar
//         checkboxes.forEach((c) => {
//             // Checkbox on click event
//             c.addEventListener("click", function () {
//                 setTimeout(function () {
//                     toggleToolbars();
//                 }, 50);
//             });
//         });

//         // Deleted selected rows
//     };

//     var toggleToolbars = function () {
//         // Define variables
//         const container = document.querySelector("#kt_datatable_example_1");
//         const toolbarSelected = document.querySelector(
//             '[data-kt-docs-table-toolbar="selected"]'
//         );
//         const selectedCount = document.querySelector(
//             '[data-kt-docs-table-select="selected_count"]'
//         );

//         // Select refreshed checkbox DOM elements
//         const allCheckboxes = container.querySelectorAll(
//             'tbody [type="checkbox"]'
//         );

//         // Detect checkboxes state & count
//         let checkedState = false;
//         let count = 0;

//         // Count checked boxes
//         allCheckboxes.forEach((c) => {
//             if (c.checked) {
//                 checkedState = true;
//                 count++;
//             }
//         });

//         // Toggle toolbars
//         if (checkedState) {
//             selectedCount.innerHTML = count;
//             toolbarBase.classList.add("d-none");
//             toolbarSelected.classList.remove("d-none");
//         } else {
//             toolbarBase.classList.remove("d-none");
//             toolbarSelected.classList.add("d-none");
//         }
//     };
// }
// postsTable();

ClassicEditor.create(document.querySelector(".editor"), {
    // Editor configuration.
})
    .then((editor) => {
        window.editor = editor;
    })
    .catch();


// intermidiate checkbox
$('input[type="checkbox"]').change(function (e) {
    var checked = $(this).prop("checked"),
        container = $(this).closest('li'), // Use closest() to find the parent li element
        siblings = container.siblings();

    container.find('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked,
    });

    function checkSiblings(el) {
        var parent = el.parent().closest('li'), // Find the closest parent li element
            all = true;

        el.siblings().each(function () {
            let returnValue = (all =
                $(this).children('input[type="checkbox"]').prop("checked") ===
                checked);
            return returnValue;
        });

        if (all && checked) {
            parent.children('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked,
            });

            checkSiblings(parent);
        } else if (all && !checked) {
            parent.children('input[type="checkbox"]').prop("checked", checked);
            parent
                .children('input[type="checkbox"]')
                .prop(
                    "indeterminate",
                    parent.find('input[type="checkbox"]:checked').length > 0
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

