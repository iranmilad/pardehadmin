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