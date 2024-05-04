import * as bootstrap from "bootstrap";

if ($("#edit_modal").length > 0) {
    let modal = new bootstrap.Modal("#edit_modal");

    $(".edit_item").on("click", function (e) {
        let parent = $(this).parent().parent().parent();
        $("#child_title").val(parent.siblings("td").find(".title-attr").text());
        $("#child_slug").val(parent.siblings("td").find(".slug-attr").text());
        $("#child_id").val($(this).data("id"));
        // Original URL
        let url = $(".modal-content").attr("action");
        let newUrl = url.replace(/\d+$/, $(this).data("id"));
        $(".modal-content").attr("action", newUrl);

        modal.show();
    });
}
