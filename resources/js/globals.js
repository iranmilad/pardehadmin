export let checkboxTableWorker = () => {
    // Define variables
    const container = document.querySelector("table");
    // Select refreshed checkbox DOM elements
    const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');
    // Detect checkboxes state & count
    let count = 0;
    allCheckboxes.forEach((item) => {
        item.addEventListener("change", function () {
            if ($(this).is(":checked")) {
                count++;
            } else {
                count--;
            }

            // if count is same as total checkboxes then check table thead tr checkbox
            if (count == allCheckboxes.length) {
                $("thead [type='checkbox']").prop("checked", true);
            } else {
                $("thead [type='checkbox']").prop("checked", false);
            }
        });
    });
};

export function intermidiateCheckbox() {
    if ($(".intermediat-checkbox").length > 0) {
        $('input[type="checkbox"]').change(function (e) {
            var checked = $(this).prop("checked"),
                container = $(this).closest("li"), // Use closest() to find the parent li element
                siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked,
            });

            function checkSiblings(el) {
                var parent = el.parent().closest("li"), // Find the closest parent li element
                    all = true;

                el.siblings().each(function () {
                    let returnValue = (all =
                        $(this)
                            .children('input[type="checkbox"]')
                            .prop("checked") === checked);
                    return returnValue;
                });

                if (all && checked) {
                    parent.children('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked,
                    });

                    checkSiblings(parent);
                } else if (all && !checked) {
                    parent
                        .children('input[type="checkbox"]')
                        .prop("checked", checked);
                    parent
                        .children('input[type="checkbox"]')
                        .prop(
                            "indeterminate",
                            parent.find('input[type="checkbox"]:checked')
                                .length > 0
                        );
                    checkSiblings(parent);
                } else {
                    el.parents("li").children('input[type="checkbox"]').prop({
                        indeterminate: true,
                        checked: false,
                    });
                }
            }

            checkSiblings(container);
        });
    }
}
