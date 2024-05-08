import { checkboxTableWorker } from "../globals";

function ProductCommentsTable() {
    if ($("#product_table_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#product_table_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "author" },
                { data: "rate" },
                { data: "product" },
                { data: "register_date" },
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

export default ProductCommentsTable;
