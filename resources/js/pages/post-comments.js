import { checkboxTableWorker } from "../globals";

function PostCommentsTable() {
    if ($("#post_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#post_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "author" },
                { data: "post" },
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

export default PostCommentsTable;
