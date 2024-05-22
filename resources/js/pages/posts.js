import { checkboxTableWorker } from "../globals";

function PostsTable() {
    if ($("#posts_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#posts_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "title" },
                { data: "author" },
                { data: "categories" },
                { data: "tags" },
                { data: "comments" },
                { data: "created_at" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
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

export default PostsTable;
