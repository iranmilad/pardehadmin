import { checkboxTableWorker } from "../globals";

function CustomerGroupTable() {
    if ($("#customer_group_table").length === 0) return;

    let initTable = function () {
        let table;
        let dt = $("#customer_group_table").DataTable({
            info: false,
            columns: [
                { data: "checkbox" },
                { data: "name_family" },
                { data: "phone" },
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
            paging: true,
            searching: false,
            pageLength: 2
        });

        dt.on("draw", () => {
            checkboxTableWorker();
        });
        dt.on("page",function () {
            $("#customer_group_table thead tr input[type='checkbox']").prop('checked',false)
        })
    };

    return {
        init: function () {
            initTable();
            checkboxTableWorker();
        },
    };
}

export default CustomerGroupTable;
