import { checkboxTableWorker } from "../globals";

function DiscountsTable() {
    if ($("#discounts_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#discounts_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "code" },
                { data: "type" },
                { data: "price" },
                { data: "products" },
                { data: "limit_or_use" },
                { data: "expiration" },
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

export default DiscountsTable;
