import autoScroll from "dom-autoscroller";
import { GenerateKanbanCard } from "../components";
import { createElement } from "preact";
import { render } from "preact-render-to-string";

// Class definition
var selectKanbanItem = null;
let mode = "create";

var detailModal = new bootstrap.Modal("#editModal", {
    keyboard: false,
});

var boardModal = new bootstrap.Modal("#boardModal", {
    keyboard: false,
});

let detailModalBlock = new KTBlockUI(
    document.querySelector("#editModal .modal-body"),
    {
        overlayClass: "tw-bg-transparent",
    }
);

let boardModalBlock = new KTBlockUI(
    document.querySelector("#boardModal .modal-body"),
    {
        overlayClass: "tw-bg-transparent",
    }
);

let bodyBlock = new KTBlockUI(
    document.querySelector("body"),
    {
        overlayClass: "tw-bg-transparent",
    }
);

var kanban = null; // Declare kanban globally

export var KanbanConfig = function (boards) {
    // Private functions
    var exampleBasic = function () {
        window["kanban"] = kanban = new jKanban({
            element: "#kanban",
            gutter: "20px",
            widthBoard: "350px",
            click: function (el) {
                let id = $(el).children("[data-id]").data("id");
                console.log()
                $.ajax({
                    url: `/api/task/${id}`,
                    beforeSend: () => detailModalBlock.block(),
                    success: (res) => {
                        $("#editModalTitle").val(res.title);
                        $("#boards-status").val(res.board); // Board status (nostatus, doing, done)
                        window['detail_modal_start_date'].setDate(res.startDate);
                        window['detail_modal_end_date'].setDate(res.endDate);
                        var newOption = new Option(res.assigneeName, res.assigneeName, false, false);
                        // Append it to the select
                        $('select.advanced_search').append(newOption).trigger('change');
                        detailModalBlock.release();
                        detailModal.show();
                    }
                })
            },
            dropEl: function (el) {
                let id = $(el).children("[data-id]").data("id");
                const newStatus = $(el).parent().parent().data("id");
                $.ajax();
            },
            boards
        });
    };

    return {
        // Public Functions
        init: function () {
            exampleBasic();
        },
    };
};

// Function to add new board
$("#addNewBoard").on("click", function () {
    const title = $("#boardTitle").val(); // Get the board title from input
    const color = $("#boardColor").val(); // Get the board color from input

    if (title && color) {
        window["kanban"].addBoards([
            {
                id: "board_" + new Date().getTime(), // Unique ID for the board
                title: `<i class="fa-solid fa-circle me-5" style="color:${color};"></i><span>${title}</span>`,
                item: [], // Empty item list
            },
        ]);

        boardModal.hide(); // Hide the modal after adding the board
    }
});

$("#addNewTask").on("click", function () {
    mode = "create";
    $("#editModal .modal-title").html("افزودن کار");
    let items = [];
    $.ajax({
        url: "/api/tasks/status",
        method: "GET",
        success: function (res) {
            res.map((item) => {
                items.push(`<option value="${item.id}">${item.title}</option>`);
            });
            $("#editModal #boards-status").html(items);
        },
    });

    detailModal.show();
});

// Handle the save button in the modal
$("#save_edit_modal").on("click", function (e) {
    e.preventDefault();

    // Get data from modal inputs
    const title = $("#editModalTitle").val();
    const status = $("#boards-status").val(); // Board status (nostatus, doing, done)
    const startDate = $("#startDate").val();
    const endDate = $("#endDate").val();
    const assignee = $(".advanced_search").find(":selected").val(); // Assignee from custom search input
    const dataId = new Date().getTime(); // Generate a unique ID for the new task

    // Check if all required data is present
    if (!title || !status || !startDate || !endDate) {
        alert("لطفا تمام فیلدها را پر کنید");
        return;
    }

    // Map the status to the board id
    let boardId = $("#boards-status").val();

    $.ajax({
        url: "/api/tasks/add",
        method: "post",
        beforeSend: function () {
            detailModalBlock.block();
        },
        data: {
            id: dataId,
            title,
            assigneeName: assignee,
            startDate,
            endDate,
            board: status
        },
        success: function (res) {
            // Generate the new card's HTML
            const newCardHtml = render(
                createElement(GenerateKanbanCard, {
                    data: {
                        id: dataId,
                        title,
                        assigneeName: assignee,
                        startDate,
                        endDate,
                    },
                })
            );

            // Add the new card to the appropriate board
            window["kanban"].addElement(boardId, {
                title: newCardHtml,
            });

            detailModalBlock.release();

            // Close the modal after saving
            detailModal.hide();
        },
        error: () => detailModalBlock.release()
    });
});

$(".close_edit_modal").on("click", function () {
    detailModal.hide();
});

export function generateBoards(){
    $.ajax({
        url: "/api/tasks",
        beforeSend: () => bodyBlock.block(),
        success: (res) => {
            bodyBlock.release();
            let boards = [];
            res.boards.map(item => {
                const title = `<i class="fa-solid fa-circle me-5" style="color:${item.color};"></i><span>${item.title}</span>`;
                const id = item.id;
                let items = [];
                item.items.map(it => items.push({title: render(
                    createElement(GenerateKanbanCard, {
                        data: {
                            id: it.id,
                            title: it.title,
                            assigneeName: it.assigneeName,
                            startDate: it.startDate,
                            endDate: it.endDate,
                        },
                    })
                ),}))
                boards.push({
                    id,
                    title,
                    items
                })
                
            })
            window["kanban"].addBoards(boards[0])
        }
    })
}