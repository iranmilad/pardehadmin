import { checkboxTableWorker } from "../globals";

function ReportsTable() {
    if ($("#reports_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#reports_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "order" },
                { data: "date" },
                { data: "status" },
                { data: "count" },
                { data: "comission" },
                { data: "payment_method" },
                { data: "duenumber" },
                { data: "transaction" },
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

export default ReportsTable;
