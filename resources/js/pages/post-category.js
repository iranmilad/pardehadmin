import { checkboxTableWorker } from "../globals";

function PostCategoryTable() {
    if ($("#post_categories").length === 0) return;
    let initTable = function () {
        let table;
        let dt = $("#post_categories").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "title" },
                { data: "description" },
                { data: "slug" },
                { data: "count" },
                { data: "created_at" },
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

export default PostCategoryTable;
