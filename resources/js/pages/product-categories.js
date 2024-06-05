import { checkboxTableWorker } from "../globals";

function ProductCategoriesTable() {
    if ($("#product_categories_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#product_categories_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "title" },
                { data: "slug" },
                { data: "parent" },
                { data: "children_count" },
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
            order: [[1, "asc"]],
            paging: false,
            searching: false,
        });

        dt.on("draw", () => {
            checkboxTableWorker();
        });
    };

    return {
        init: function () {
            initTable();
            checkboxTableWorker();
        },
    };
}

export default ProductCategoriesTable;
