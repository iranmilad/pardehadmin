import { GridStack } from "gridstack";
import "gridstack/dist/gridstack.min.css";
import { FormItemSettings } from "./components";
import { h, createElement, hydrate } from "preact";
import formElementsReducer, {
    addFormElement as reduxAddFormElement,
    removeFormElement,
    updateFormElement,
    updateDetail,
    updateWholeState,
    resetAll,
} from "./redux";
import { configureStore } from "@reduxjs/toolkit";

window["store"] = configureStore({
    reducer: {
        formElements: formElementsReducer, // Attach the formElements slice reducer
    },
});

// Get appropriate icon for the form element type
var getIconForType = (window["getIconForType"] = (type) => {
    switch (type) {
        case "input":
            return '<i class="fas fa-i-cursor"></i>';
        case "checkbox":
            return '<i class="fas fa-check-square"></i>';
        case "radio":
            return '<i class="fas fa-dot-circle"></i>';
        case "select":
            return '<i class="fas fa-list"></i>';
        case "textarea":
            return '<i class="fas fa-align-left"></i>';
        case "number":
            return '<i class="fas fa-hashtag"></i>';
        case "hidden":
            return '<i class="fas fa-eye-slash"></i>';
        case "file-upload":
            return '<i class="fas fa-upload"></i>';
        case "email":
            return '<i class="fas fa-envelope"></i>';
        case "website":
            return '<i class="fas fa-globe"></i>';
        case "image":
            return '<i class="fas fa-image"></i>';
        case "text":
            return '<i class="fas fa-font"></i>';
        default:
            return "";
    }
});

export var modal = document.querySelector("#editModal")
    ? new bootstrap.Modal(document.getElementById("editModal"))
    : null;
// Initialize Gridstack
var grid = null;
if (document.querySelector("#form-elements")) {
    grid = GridStack.init({
        cellHeight: "80px",
        verticalMargin: 10,
        column: 12,
        rtl: true,
        resizable: {
            handles: "e, w",
        },
    });
}

document.addEventListener("DOMContentLoaded", function () {
    let resizing = false; // Flag to track resizing state

    if ($("#form-elements").length > 0) {
        var defaultConfig = $("#form-elements").val();
        if (defaultConfig !== "") {
            defaultConfig = JSON.parse(defaultConfig);
            defaultConfig.forEach((element) => {
                addFormElement(
                    element.type,
                    element.title,
                    element.value,
                    element.required,
                    element.id,
                    element.w,
                    element.h,
                    element.x,
                    element.y
                );
            });
        }
    }

    // Attach event listener for grid resizing
    if (typeof grid === "function") {
        grid.on("resize", function (event, el) {
            resizing = true; // Set resizing flag to true
        });

        grid.on("resizestop", function (event, el) {
            const itemId = el.getAttribute("data-gs-id");

            const node = el.gridstackNode;
            const w = node.w;
            const h = node.h;
            const x = node.x;
            const y = node.y;

            window["store"].dispatch(
                updateDetail({
                    id: itemId,
                    w,
                    h,
                    x,
                    y,
                })
            );
        });

        grid.on("dragstop", function (event, el) {
            // Get all grid items (widgets)
            const allItems = grid.engine.nodes;

            // Iterate over each grid item and log or dispatch its position
            let newPosition = [];

            allItems.forEach((item) => {
                const itemId = item.id || item.el.getAttribute("data-gs-id"); // Retrieve unique ID
                const x = item.x;
                const y = item.y;
                const w = item.w;
                const h = item.h;

                newPosition.push({
                    id: itemId,
                    x,
                    y,
                    w,
                    h,
                });
            });
            window["store"].dispatch(updateWholeState(newPosition));
        });
    }

    // Enable dragging for form items
    document.querySelectorAll(".form-item").forEach(function (item) {
        item.addEventListener("dragstart", function (event) {
            event.dataTransfer.setData(
                "text/plain",
                event.target.getAttribute("data-type")
            );
        });
    });

    // Gridstack drop area
    if (document.querySelector(".grid-stack")) {
        document
            .querySelector(".grid-stack")
            .addEventListener("dragover", function (event) {
                event.preventDefault();
            });
    }

    if (document.querySelector(".grid-stack")) {
        document
            .querySelector(".grid-stack")
            .addEventListener("drop", function (event) {
                event.preventDefault();
                var type = event.dataTransfer.getData("text/plain");
                addFormElement(type);
            });
    }

    // Save changes and update the grid item dimensions
});

function generateUUID() {
    return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
        /[xy]/g,
        function (c) {
            const r = (Math.random() * 16) | 0,
                v = c === "x" ? r : (r & 0x3) | 0x8;
            return v.toString(16);
        }
    );
}

var openModal = (itemId) => {
    // Find the corresponding element in the formElements array
    const elementId = $(itemId).attr("data-gs-id");
    const element = window["store"]
        .getState()
        .formElements.formElements.find((el) => el.id === elementId);

    // Check if the element exists
    if (element) {
        // Get the modal content (overall modal element)
        const modalContent = document.getElementById("editModal");

        // Find the modal-header element
        const modalHeader = modalContent.querySelector(".modal-header");

        // Check if modal-header exists
        if (modalHeader) {
            // Remove all other content in the modal except for modal-header
            $(modalContent).find(".modal-body,.modal-footer").remove();

            // Create a div to hold the Preact component after the modal-header
            const formContainer = document.createElement("div");

            // Create the Preact element for FormItemSettings
            const preactElement = createElement(FormItemSettings, {
                id: elementId,
                type: element.type,
                title: element.title,
                value: element.value, // Pass items if they exist
                required: element.required,
            });

            // Render the Preact component into the new div
            hydrate(preactElement, formContainer);

            // Insert the formContainer (with the Preact component) after the modal-header
            modalHeader.insertAdjacentElement("afterend", formContainer);
        }

        // Show the modal
        modal.show();
    }
};

export var addFormElement = (
    type,
    title = "عنوان",
    value = "",
    required = false,
    id = generateUUID(),
    w = 12,
    h = 1,
    x,
    y
) => {
    const content = `
        <div class="grid-stack-item-content">
            ${getIconForType(type)} ${title}
        </div>
    `;

    const formElement = {
        id: id,
        type: type,
        title: title,
        value:
            type === "select" || type === "radio" || type === "checkbox"
                ? []
                : "",
        required,
        w: w,
        h: h,
        x: x || 0,
        y: y,
    };

    if (type === "select" || type === "radio" || type === "checkbox") {
        if (value.length === 0) {
            formElement.value = [];
        } else {
            formElement.value = value;
        }
    }

    window["store"].dispatch(reduxAddFormElement(formElement));

    // Use grid.addWidget to add the new form element with provided x, y, w, and h values
    grid.addWidget(
        $("<div></div>")
            .attr("data-gs-id", id)
            .append(content)
            .prop("outerHTML"),
        {
            x: x,
            y: y,
            w: w,
            h: h,
        }
    );

    // Attach the click event to the newly added item using jQuery
    const gridItem = $(".grid-stack .grid-stack-item:last-child");
    gridItem.on("click", function (event) {
        if (
            !event.target.classList.contains("ui-resizable-handle") &&
            event.target.classList.contains("grid-stack-item-content") &&
            !event.target.classList.contains("ui-resizable-autohide")
        ) {
            // Only open modal if not resizing and not clicking on the resize icon
            openModal($(this)); // Pass the clicked item to the modal function
        }
    });
};

export function saveChanges(id, items, newTitle, newRequired) {
    // Retrieve the formElements array from the Redux store
    const formElements = window["store"].getState().formElements.formElements;

    // Find the corresponding element in the formElements array by ID
    const elementIndex = formElements.findIndex((el) => el.id === id);
    const element = formElements[elementIndex];

    if (element) {
        // Dispatch the updated element to Redux store
        window["store"].dispatch(
            updateFormElement({
                id,
                title: newTitle,
                value: items,
                required: newRequired,
            })
        );

        // Optionally update the displayed element in the grid
        const gridItem = document.querySelector(
            `.grid-stack-item[data-gs-id="${id}"]`
        );
        if (gridItem) {
            const content = gridItem.querySelector(".grid-stack-item-content");
            content.innerHTML =
                window["getIconForType"](element.type) + " " + newTitle;
        }
    }

    // Close the modal
    const modal = bootstrap.Modal.getInstance(
        document.getElementById("editModal")
    );
    modal.hide();
}

export function removeElement(id) {
    // Confirm before deletion (optional)
    const confirmDelete = window.confirm(
        "آیا از پاک کردن این فیلد مطعمن هستید ؟"
    );
    if (!confirmDelete) return;

    // Dispatch the remove action to Redux
    window["store"].dispatch(removeFormElement(id));

    // Get the updated form elements from the Redux store after deletion
    const formElements = window["store"].getState().formElements.formElements;

    // Remove all widgets from the grid
    grid.removeAll();
    window["store"].dispatch(resetAll());

    // Loop through the formElements array and re-add each widget to the grid
    formElements.forEach((element) => {
        addFormElement(
            element.type,
            element.title,
            element.value,
            element.required,
            element.id,
            element.w,
            element.h,
            element.x,
            element.y
        );
    });

    // Optionally, hide the modal after deletion
    const modal = bootstrap.Modal.getInstance(
        document.getElementById("editModal")
    );
    modal.hide();
}

$("#close-form-element").on("click", function () {
    modal.hide();
});
