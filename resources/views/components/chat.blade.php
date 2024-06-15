<div class="chatbox">
    <div class="header">
        <!-- TITLE OF MESSAGE -->
        <span></span>
        <a href="{{route('sessions.list')}}" class="btn custom-btn-primary btn-sm  tw-rounded-xl">بازگشت</a>
    </div>
    <div class="main">
        <!-- MESSAGES -->
    </div>
    <div class="tw-px-5">
        <form action="/sessions/notifications" method="post" class="send-box" id="send-box">
            @csrf
            <input type="hidden" name="session" value="{{ $session->id }}">
            <button type="button" class="btn tw-text-gray-400" id="exist-message-file">
                <i class="fa-regular fa-paperclip "></i>
            </button>
            <textarea name="message" id="" placeholder="متن خود را بنویسید"></textarea>

            <!-- an array of ids of uploaded files -->
            <input type="hidden" name="msg_id" id="message_id">
            <button type="submit" class="btn custom-btn-primary" id="sendMessage">
                <i class="fa-solid fa-paper-plane-top"></i>
            </button>
        </form>
    </div>
</div>
