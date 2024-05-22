import { checkboxTableWorker } from "../globals";

function ChecksTable() {
    if ($("#checks_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#checks_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "user" },
                { data: "all_checks" },
                { data: "paied" },
                { data: "last_paied" },
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

export default ChecksTable;
