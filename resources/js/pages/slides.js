import $ from "jquery";
import "jquery.repeater";

if ($("#slider_banner").length > 0) {
    $("#slider_banner").repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function (setIndexes) {
            console.log("first");
        },
        isFirstItemUndeletable: true,
    });
}

if ($("#comments_banner").length > 0) {
    $("#comments_banner").repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function (setIndexes) {
            console.log("first");
        },
        isFirstItemUndeletable: true,
    });
}
