function UsersTable() {
    let table;
    let dt = $("#users_table").DataTable({
        info: false,
        columns: [
            { data: "checkbox" },
            { data: "username" },
            { data: "fullname" },
            { data: "email" },
            { data: "role" },
            { data: "posts" },
            { data: "action" },
        ],
        columnDefs: [
            {
                targets: 0,
                orderable: false,
            },
            {
                targets: -1,
                orderable: false,
                className: "text-end",
            },
        ],
        order: false,
        paging: false,
        searching: false,
        destroy: true,
        retrieve: true,
    });

    dt.draw();

    dt.on("draw", () => {
        initToggleToolbar();
        toggleToolbars();
    });

    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector("#users_table");
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
        const container = document.querySelector("#users_table");
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

export default UsersTable;