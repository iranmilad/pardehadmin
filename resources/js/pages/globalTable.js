import { checkboxTableWorker } from "../globals";

function GlobalTable() {
    if ($("#global_table").length === 0) return;

    // get count of table thead th
    let countTh = $("#global_table thead th").length;
    let cols = [];
    for (let i = 0; i < countTh; i++) {
        // random string and number
        let randomString = Math.random().toString(36).substring(7);
        cols.push({
            data: randomString,
        })
    }

    let initTable = function () {
        let table;
        let dt = $("#global_table").DataTable({
            info: false,
            columns: cols,
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

export default GlobalTable;
