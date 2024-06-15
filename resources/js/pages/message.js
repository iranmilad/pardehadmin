import $ from "jquery";
import { hydrate, createElement } from "preact";
import { Messages } from "../components";

document.addEventListener("DOMContentLoaded", function () {
    var block = new KTBlockUI(
        document.getElementById("kt_app_toolbar_container"),
        {
            overlayClass: "z-[999999]",
        }
    );
    let timestamp = 0;
    // check timestamp
    let timestampInterval = null;
    if (window["msg-page"]) {
        // get everything after last slash
        let id = window.location.href.split("/").pop();
        if (id) {
            fetchMessages(id);
            $("#send-box #message_id").val(id);
            console.log(block);
        }
    }

    function fetchMessages(id, action) {
        let token = $('#send-box [name="_token"]').val();
        $.ajax({
            url: `/api/messages/${id}`,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                if (action !== "interval") {
                    block.block();
                }
            },
            success: function (data) {
                timestamp = data.message.timestamp;
                $(".chatbox .header span").html(data.message.title);
                hydrate(
                    createElement(Messages, {
                        messages: data.message.messages,
                    }),
                    document.querySelector(".chatbox .main")
                );
                block.release();
                $(".chatbox").fadeIn(200);
                if ($(window).width() < 992) {
                    $("body").css("overflow", "hidden");
                    // set scroll to top 0
                }
                clearInterval(timestampInterval);
                timestampInterval = setInterval(() => {


                    $.ajax({
                        url: `/api/messages/${id}`,
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (+response.timestamp !== +timestamp) {
                                fetchMessages(id, "interval");
                            }
                        },
                    });
                }, 5000);
            },
            error: function (xhr, status, error) {
                block.release();
            },
        });
    }

    let allowSend = false;

    $("#send-box [name='message']").on("input", function (event) {
        let val = $(this).val().trim();
        // check no space and no empty and no null and whitespace
        let regex = new RegExp("^(?![\\s\\S])");
        if (val.length > 0 && !regex.test(val)) {
            allowSend = true;
            $("#sendMessage").css("display", "block");
        } else {
            allowSend = false;
            $("#sendMessage").css("display", "none");
        }
    });


    let url = new URL(window.location.href);
    if (url.pathname === "/sessions/notifications") {
        let id = url.searchParams.get("id");
        if (id) {
            fetchMessages(id);
            $("#send-box #message_id").val(id);
        }
    }


});
