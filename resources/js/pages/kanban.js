import autoScroll from "dom-autoscroller";
import { GenerateKanbanCard } from "../components";
import { createElement } from "preact";
import { render } from "preact-render-to-string";

// Class definition
var selectKanbanItem = null;
var selectKanban = null;
var selectKanbanMode = "create";
let mode = "create";
let cardMode = "create";

if($("#kanban").length > 0) {
    var detailModal = new bootstrap.Modal("#editModal", {
        keyboard: false,
    });
    
    var boardModal = new bootstrap.Modal("#boardModal", {
        keyboard: false,
    });
    
    var detailModalBlock = new KTBlockUI(
        document.querySelector("#editModal .modal-body"),
        {
            overlayClass: "tw-bg-transparent",
        }
    );
    
    var boardModalBlock = new KTBlockUI(
        document.querySelector("#boardModal .modal-body"),
        {
            overlayClass: "tw-bg-transparent",
        }
    );
}



let bodyBlock = new KTBlockUI(document.querySelector("body"), {
    overlayClass: "tw-bg-transparent",
});

var kanban = null; // Declare kanban globally

export var KanbanConfig = function (boards = []) {
    // Private functions
    var exampleBasic = function () {
        window["kanban"] = kanban = new jKanban({
            element: "#kanban",
            gutter: "20px",
            widthBoard: "350px",
            dragendEl: function (el) {
                const cardId = $(el).find(".kanban-card").data("id"); // Get the ID of the dragged card
                const boardId = $(el).closest(".kanban-board").data("id"); // Get the ID of the board the card belongs to
                const allCardsInBoard = $(el)
                    .closest(".kanban-board")
                    .find(".kanban-card"); // Get all cards in the current board

                // Calculate the new position of the card
                const newPosition = Array.from(allCardsInBoard).findIndex(
                    (card) => $(card).data("id") === cardId
                ); // 1-based index

                // Prepare the data for the AJAX request
                const requestData = {
                    id: cardId,
                    board: boardId,
                    position: newPosition, // New position of the card in the board
                };

                // Send the POST request to update the card position
                $.ajax({
                    url: "/api/tasks/update-card", // The API endpoint
                    type: "POST",
                    data: JSON.stringify(requestData), // Convert the request data to JSON
                    contentType: "application/json", // Set the content type to JSON
                    error: function (error) {
                        window["Alarm"]({
                            msg: "مشکلی پیش آمده",
                            type: "error",
                        });
                    },
                });
            },

            dragendBoard: function (el) {
                const boardId = $(el).data("id"); // Get the ID of the dragged board
                const allBoards = $("#kanban .kanban-board"); // Get all boards
                const newPosition =
                    allBoards
                        .toArray()
                        .findIndex((board) => $(board).data("id") === boardId) +
                    1; // Calculate the new position (1-based)

                // Prepare the data for the AJAX request
                const requestData = {
                    id: boardId,
                    position: newPosition, // New position
                };

                // Send the POST request to update the Kanban position
                $.ajax({
                    url: "/api/tasks/update-kanban", // The API endpoint
                    type: "POST",
                    data: JSON.stringify(requestData), // Convert the request data to JSON
                    contentType: "application/json", // Set the content type to JSON
                    success: function (response) {},
                    error: (error) =>
                        window["Alarm"]({
                            msg: "مشکلی پیش آمده",
                            type: "error",
                        }),
                });
            },
            click: function (el) {
                let id = $(el).data("eid");
                selectKanbanItem = id;
                $.ajax({
                    url: `/api/task/${id}`,
                    beforeSend: () => detailModalBlock.block(),
                    success: (res) => {
                        $("#editModalTitle").val(res.title);
                        $("#boards-status").val(res.board); // Board status (nostatus, doing, done)
                        $("#startDate").val(res.startDate);
                        $("#endDate").val(res.endDate);
                        var newOption = new Option(
                            res.assigneeName,
                            res.assigneeName,
                            false,
                            false
                        );
                        // Append it to the select
                        $("select.advanced_search")
                            .append(newOption)
                            .trigger("change");
                        detailModalBlock.release();
                        $("#save_edit_modal").html("ذخیره");
                        cardMode = "update";
                        $("#removeKanbanItem").show();
                        detailModal.show();
                    },
                    error: () =>
                        window["Alarm"]({
                            msg: "مشکلی پیش آمده",
                            type: "error",
                        }),
                });
            },
            boards,
        });
    };

    return {
        // Public Functions
        init: function () {
            exampleBasic();
        },
    };
};

$("#addNewBoard").on("click", function () {
    const title = $("#boardTitle").val(); // Get the board title from input
    const color = $("#boardColor").val(); // Get the board color from input

    if (!title || !color) return; // Exit early if title or color is missing

    let boardId =
        selectKanbanMode === "create"
            ? `board_${new Date().getTime()}`
            : selectKanban; // Set board ID based on mode
    const requestData = {
        id: boardId,
        title: title,
        color: color,
        position:
            selectKanbanMode === "create"
                ? $("#kanban .kanban-board").length + 1
                : $("#kanban .kanban-board")
                      .toArray()
                      .findIndex((board) => $(board).data("id") === boardId) +
                  1,
    };

    // Determine the API endpoint based on the mode
    const apiUrl =
        selectKanbanMode === "create"
            ? "/api/tasks/create-kanban"
            : "/api/tasks/update-kanban";

    // AJAX request for creating or updating the board
    $.ajax({
        url: apiUrl, // The API endpoint
        type: "POST",
        data: JSON.stringify(requestData), // Convert the request data to JSON
        contentType: "application/json", // Set the content type to JSON
        beforeSend: () => boardModalBlock.block(),
        success: function () {
            if (selectKanbanMode === "create") {
                window["kanban"].addBoards([
                    {
                        id: boardId,
                        title: `<i class="fa-solid fa-circle me-5" style="color:${color};"></i><span>${title}</span>`,
                        item: [],
                    },
                ]);
            } else {
                const boardElement = $(
                    `#kanban .kanban-board[data-id='${boardId}']`
                );
                boardElement
                    .find(".kanban-title-board")
                    .html(
                        `<i class="fa-solid fa-circle me-5" style="color:${color};"></i><span>${title}</span>`
                    );
            }
            boardModalBlock.release();
            boardModal.hide();
        },
        error: function () {
            boardModalBlock.release();
            window["Alarm"]({ msg: "مشکلی پیش آمده", type: "error" });
        },
    });
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
        error: () => window["Alarm"]({ msg: "مشکلی پیش آمده", type: "error" }),
    });
    $("#save_edit_modal").html("افزودن");
    cardMode = "create";
    $("#removeKanbanItem").hide();
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

    // Check if all required data is present
    if (!title || !status || !startDate || !endDate) {
        alert("لطفا تمام فیلدها را پر کنید");
        return;
    }

    // Map the status to the board id
    const nextBoardId = status; // Assuming status is the next board ID

    // Determine if it's a create or update operation
    let url, dataId;

    if (cardMode === "create") {
        // Create mode: generate a new task ID
        dataId = new Date().getTime(); // Unique ID for the new task
        url = "/api/tasks/add";
    } else {
        // Update mode: use existing task ID
        dataId = selectKanbanItem; // Assuming existing task ID is stored
        url = "/api/tasks/update";
    }

    $.ajax({
        url,
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
            board: status,
        },
        success: function (res) {
            // Generate the new or updated card's HTML
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

            // Find the appropriate Kanban board and card element
            const currentCardElement = $(`.kanban-card[data-id='${dataId}']`);
            const currentBoardId = currentCardElement
                .closest(".kanban-board")
                .data("id");
            if (currentBoardId !== nextBoardId) {
                // If the card is in a different board, remove it from the old board
                window["kanban"].removeElement(`${dataId}`); // Make sure dataId matches the card's ID

                // Add the card to the new board
                window["kanban"].addElement(nextBoardId, {
                    id: dataId,
                    title: newCardHtml,
                });
            } else {
                // If the card is in the same board, just replace its content
                window["kanban"].replaceElement(dataId, newCardHtml);
            }

            detailModalBlock.release();

            // Close the modal after saving
            detailModal.hide();
        },
        error: () => {
            detailModalBlock.release(),
                window["Alarm"]({ msg: "مشکلی پیش آمده", type: "error" });
        },
    });
});

$(".close_edit_modal").on("click", function () {
    detailModal.hide();
});

export function generateBoards() {
    $.ajax({
        url: "/api/tasks",
        beforeSend: () => bodyBlock.block(),
        success: (res) => {
            bodyBlock.release();
            let boards = [];
            res.boards.map((item) => {
                const title = `<i class="fa-solid fa-circle me-5" style="color:${item.color};"></i><span>${item.title} <i class="fa-solid fa-gear"></i></span>`;
                const id = item.id;
                let items = [];
                item.items.map((it) =>
                    items.push({
                        id: it.id,
                        title: render(
                            createElement(GenerateKanbanCard, {
                                data: {
                                    id: it.id,
                                    title: it.title,
                                    assigneeName: it.assigneeName,
                                    startDate: it.startDate,
                                    endDate: it.endDate,
                                },
                            })
                        ),
                    })
                );
                boards.push({
                    id,
                    title,
                    item: items,
                });
            });

            window["kanban"].addBoards(boards);
        },
        error: (error) => {
            window["Alarm"]({ msg: "مشکلی پیش آمده", type: "error" });
        },
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Function to remove and add the click listener to kanban board headers
    function updateClickListener() {
        // Remove any previously attached click listeners
        $("header.kanban-board-header").off("click");

        // Add the new click listener
        $("header.kanban-board-header").on("click", function () {
            $("#addNewBoard").html("بروزرسانی");
            $("#removeKanban").show();
            const id = $(this).parent().data("id"); // Get the board ID
            boardModal.show(); // Show the board modal
            selectKanban = id; // Store the selected board ID
            selectKanbanMode = "update"; // Set mode to 'update'

            // Extract the color from the <i> tag and the title from the <span> tag
            const color = $(this).find(".kanban-title-board i").css("color"); // Get the icon color
            const title = $(this).find(".kanban-title-board span").text(); // Get the title text

            // Set the modal inputs with the extracted values
            $("#boardTitle").val(title); // Set the board title input
            $("#boardColor").val(color); // Set the board color input
            window["boardColor"].setColor(color);
        });
    }

    // Create a MutationObserver to watch for added .kanban-board elements
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach(function (node) {
                    if (
                        node.classList &&
                        node.classList.contains("kanban-board")
                    ) {
                        // Update the listener when a new kanban board is added
                        updateClickListener();
                    }
                });
            }
        });
    });

    // Start observing the body for child element changes
    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });

    // Initially update the click listeners for existing .kanban-board elements
    updateClickListener();
});

$("#addNewBoardModal").on("click", function () {
    $("#addNewBoard").html("افزودن");
    $("#removeKanban").hide();
    selectKanbanMode = "create";
    boardModal.show();
});

$("#removeKanbanItem").on("click", function () {
    $.ajax({
        url: "/api/tasks/remove",
        data: {
            id: `${selectKanbanItem}`,
        },
        method: "POST",
        beforeSend: () => detailModalBlock.block(),
        success: (res) => {
            detailModalBlock.release();
            detailModal.hide();
            window["kanban"].removeElement(`${selectKanbanItem}`);
        },
        error: () => {
            detailModalBlock.release();
            window["Alarm"]({ msg: "مشکلی پیش آمده", type: "error" });
        },
    });
});

$("#removeKanban").on("click", function () {
    $.ajax({
        url: "/api/tasks/remove-card",
        data: {
            id: `${selectKanban}`,
        },
        method: "POST",
        beforeSend: () => boardModalBlock.block(),
        success: (res) => {
            boardModalBlock.release();
            boardModal.hide();
            window["kanban"].removeBoard(selectKanban);
        },
        error: () => {
            boardModalBlock.release();
            window["Alarm"]({ msg: "مشکلی پیش آمده", type: "error" });
        },
    });
});
