import Sortable from "sortablejs";

// generate coupen code
function generateCouponCode(length) {
    let letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let code = "";
    for (let i = 0; i <= length; i++) {
        code += letters.charAt(Math.floor(Math.random() * letters.length));
    }
    return code;
}

document.addEventListener("DOMContentLoaded", () => {
    generateSortable();
});

function generateSortable() {
    if (window["sortable"]) {
        window["sortable"].destroy();
    }
    let el = document.getElementById("menu_lists");
    let sortable = (window["sortable"] = Sortable.create(el, {
        animation: 150,
        group: "shared",
        handle: null,
        swapThreshold: 0.3,
        onSort: (evt) => {
            resortFieldsNames($(el).children());
        },
        onUpdate: function (evt) {
            // Find all direct children of the main list
            var children = el.children;
            // Loop through each child div
            for (var i = 0; i < children.length; i++) {
                var child = children[i];

                // Check if the child does not already contain a nested list
                if (!child.querySelector(".nested-list")) {
                    // Create a new div with class 'nested-list'
                    var nestedList = document.createElement("div");
                    nestedList.classList.add("nested-list");

                    // Append the nested list to the child
                    child.appendChild(nestedList);

                    // Initialize Sortable.js on the new nested list
                    Sortable.create(nestedList, {
                        animation: 150,
                        group: "shared",
                        handle: null,
                        swapThreshold: 0,
                    });
                }
            }
        },
    }));
    var children = el.children;
    // Loop through each child div
    for (var i = 0; i < children.length; i++) {
        var child = children[i];

        // Check if the child does not already contain a nested list
        if (!child.querySelector(".nested-list")) {
            // Create a new div with class 'nested-list'
            var nestedList = document.createElement("div");
            nestedList.classList.add("nested-list");

            // Append the nested list to the child
            child.appendChild(nestedList);

            // Initialize Sortable.js on the new nested list
            Sortable.create(nestedList, {
                animation: 150,
                group: "shared",
                handle: null,
                onSort: (evt) => {
                    resortFieldsNames($(el).children());
                }
            });
        }
    }
    resortFieldsNames($(el).children());
    let nestedItems = document.querySelectorAll(".nested-list");
    nestedItems.forEach((item) => {
        Sortable.create(item, {
            animation: 150,
            group: "shared",
            handle: null,
            onSort: (evt) => {
                resortFieldsNames($(el).children());
            }
        });
    });
    return sortable;
}

$(".custom-link-gen").on("click", function () {
    let title = $(this).parent().find(".custom-link-title").val();
    let link = $(this).parent().find(".custom-link-link").val();
    let parent = generateCouponCode(12);
    let sub = generateCouponCode(12);
    addAccordionItem(sub, title, link);
    $(this).parent().find(".custom-link-title").val("");
    $(this).parent().find(".custom-link-link").val("");
});

function addAccordionItem(subId, title, link,alias) {
    const uniqueId = `accordion-${Date.now()}`;
    const accordionHtml = `
        <div>
            <div class="accordion" id="${uniqueId}">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${subId}" aria-expanded="false" aria-controls="${subId}">
                            ${title}
                        </button>
                    </h2>
                    <div id="${subId}" class="accordion-collapse collapse" data-bs-parent="#${uniqueId}">
                        <div class="accordion-body">
                            <div class="mb-5">
                                <label for="" class="form-label">عنوان</label>
                                <input name="menu[${subId}][title]" type="text" class="form-control" value="${title}">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">لینک</label>
                                <input name="menu[${subId}][link] type="link" class="form-control" value="${link}" placeholder="https://example.com">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">نام مستعار</label>
                                <input name="menu[${subId}][alias] type="text" class="form-control" placeholder="" value="${alias}_${Math.floor(Math.random() * 500)}">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">آیکون</label>
                                <input name="menu[${subId}][icon]  type="file" class="form-control">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">نمایش عنوان</label>
                                <select name="menu[${subId}][show_title] id="" class="form-select">
                                    <option value="1">بله</option>
                                    <option value="0" selected>خیر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nested-list">
                <!-- Your nested div content here -->
            </div>
        </div>
    `;

    const $accordion = $(accordionHtml);

    // Create the remove button
    var $removeButton = $("<button>", {
        text: "حذف",
        class: "btn btn-sm btn-danger",
        type: "button",
        click: function (e) {
            e.preventDefault();
            $(this)
                .closest(".accordion")
                .parent()
                .slideUp(400, function () {
                    $(this).remove();
                });
            resortFieldsNames($("#menu_lists").children());
        },
    });

    // Append the remove button to the accordion body
    $accordion.find(".accordion-body").append($removeButton);

    // Append the accordion to the menu list
    $("#menu_lists").append($accordion);

    generateSortable();
}

$(".accordion-item .remove-accordion").on("click", function (e) {
    e.preventDefault();
    $(this)
        .closest(".accordion")
        .parent()
        .slideUp(400, function () {
            $(this).remove();
        });
    resortFieldsNames($("#menu_lists").children());
});

$("#menu-form").on("submit", function (e) {
    e.preventDefault();
});

$(".other_items_menu").on("click", function (e) {
    let checkboxes = $(this)
        .closest(".accordion")
        .find("input[type='checkbox']:checked");
    if (checkboxes.length > 0) {
        checkboxes.each((index, item) => {
            let title = $(item).data("title");
            let link = $(item).data("link");
            let alias = $(item).data("alias");
            let sub = generateCouponCode(12);
            addAccordionItem(sub, title, link,alias);
            $(item).prop("checked", false);
        });
    }
});

/**
 * @desc - resort the fields names
 * @param { } elm
 * @param {*} parentPath
 */
function resortFieldsNames(elm, parentPath = "") {
    let childrens = $(elm);
    childrens.each((index, item) => {
        let currentPath = parentPath ? `${parentPath}[${index}]` : `[${index}]`;

        let title = $(item).children(".accordion").find("input.title");
        let url = $(item).children(".accordion").find("input.link");
        let file = $(item).children(".accordion").find("input.icon");
        let slug = $(item).children(".accordion").find("input.slug");
        let show_title = $(item).children(".accordion").find("select.show_title");

        title.attr("name", `menu${currentPath}[title]`);
        url.attr("name", `menu${currentPath}[url]`);
        file.attr("name", `menu${currentPath}[icon]`);
        slug.attr("name", `menu${currentPath}[slug]`);
        show_title.attr("name", `menu${currentPath}[show_title]`);


        if ($(item).children(".nested-list").length > 0) {
            resortFieldsNames(
                $(item).children(".nested-list").children(),
                currentPath
            );
        }
    });
}
