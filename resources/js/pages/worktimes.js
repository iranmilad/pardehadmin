import { checkboxTableWorker } from "../globals";

function WorktimesTable() {
    if ($("#worktimes_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#worktimes_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "user" },
                { data: "phone" },
                { data: "role" },
                { data: "date" },
                { data: "time_needed" },
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

export default WorktimesTable;
