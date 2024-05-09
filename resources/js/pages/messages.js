import { checkboxTableWorker } from "../globals";

function MessagesTable() {
    if ($("#messages_table").length === 0) return;
    let columns = [
        { data: "title" },
        { data: "section" },
        {data: "priority"},
        {data: 'date'},
        { data: "action" },
    ];
    if(window['deleteAble'] && window['deleteAble'] === true){
        columns.unshift({
            data: "checkbox"
        })
    }
    let initTable = function () {
        let table;
        let dt = $("#messages_table").DataTable({
            info: false,
            columns,
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

export default MessagesTable;
