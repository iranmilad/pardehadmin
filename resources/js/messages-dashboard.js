import $ from "jquery";
import { hydrate, createElement } from "preact";
import "jquery-validation";

let block = new KTBlockUI(document.getElementById("messages-whole-box"), {
    overlayClass: "z-[999999]",
});
let timestamp = 0;
// check timestamp
let timestampInterval = null;

$(".messages-private-box").on("click", function (event) {
    let id = $(this).data("id");
    window.history.pushState("", "", `?id=${id}`);
    fetchMessages(id);
    $("#send-box #message_id").val(id);
});

document.addEventListener("DOMContentLoaded", function () {
    let url = new URL(window.location.href);
    if (url.pathname === "/dashboard/notifications") {
        let id = url.searchParams.get("id");
        if (id) {
            fetchMessages(id);
            $("#send-box #message_id").val(id);
        }
    }
});

$("#chatbox-back").on("click", function (event) {
    $(".chatbox").fadeOut(200);
    window.history.pushState("", "", window.location.pathname);
    $("body").css("overflow", "auto");
    $("#send-box #message_id").val("");
    clearInterval(timestampInterval);
});

function fetchMessages(id) {
    $.ajax({
        url: `/api/messages/${id}`,
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            block.block();
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
                let url = new URL(window.location.href);
                let id = url.searchParams.get("id");
                let token = $('#send-box [name="_token"]').val();

                $.ajax({
                    url: `/api/messages/${id}/timestamp`,
                    method: "GET",
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    success: (response) => {
                        if (+response.timestamp !== +timestamp) {
                            fetchMessages(id);
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

export const Messages = ({ messages }) => {
    return messages.map((message, id) => {
        if (message.you === true) {
            return (
                <div class="your">
                    {message.message && (
                        <div class="text-chat">
                            <span>{message.message}</span>
                            <span class="chat-time">{message.created_at}</span>
                        </div>
                    )}
                    <span class="chat-time">{message.created_at}</span>
                    <div class="files">
                        {message.files.map((file, id) => (
                            <a key={id} href={file} target="_blank">
                                <img src={file} alt={`ID_` + id} />
                            </a>
                        ))}
                    </div>
                </div>
            );
        } else {
            return (
                <div class="its-box">
                    <div class="profile">
                        <i class="fa-light fa-user"></i>
                    </div>
                    <div class="its">
                        <div class="text-chat">
                            <span>{message.message}</span>
                            <span class="chat-time">{message.created_at}</span>
                        </div>
                        <div class="files">
                            {message.files.map((file, id) => (
                                <a key={id} href={file} target="_blank">
                                    <img src={file} alt={`ID_` + id} />
                                </a>
                            ))}
                        </div>
                    </div>
                </div>
            );
        }
    });
};
