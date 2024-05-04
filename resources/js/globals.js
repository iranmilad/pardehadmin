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
