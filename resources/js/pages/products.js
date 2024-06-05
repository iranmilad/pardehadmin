import { checkboxTableWorker } from "../globals";

function ProductsTable() {
    if ($("#products_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#products_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "thumbnail" },
                { data: "title" },
                { data: "sku" },
                { data: "stock" },
                { data: "price" },
                { data: "category" },
                { data: "tags" },

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

export default ProductsTable;
