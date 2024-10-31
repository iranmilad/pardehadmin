import { h, createElement, hydrate } from "preact";
import { useEffect, useState } from "preact/hooks";
import { modal, saveChanges, removeElement, addFormElement } from "./form";

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

// Repeater Component
const Repeater = ({ items, onChange }) => (
    <div>
        {items.map((item, index) => (
            <div className="row" key={index} style={{ marginBottom: "8px" }}>
                <div className="col-md-5">
                    <label className="form-label" htmlFor="">
                        عنوان
                    </label>
                    <input
                        type="text"
                        value={item.title}
                        className="form-control"
                        onChange={(e) => {
                            const newItems = [...items];
                            // Create a deep copy of the item
                            newItems[index] = {
                                ...newItems[index],
                                title: e.target.value,
                            };
                            onChange(newItems);
                        }}
                    />
                </div>
                <div className="col-md-5">
                    <label className="form-label" htmlFor="">
                        مقدار
                    </label>
                    <input
                        type="text"
                        value={item.value}
                        className="form-control"
                        onChange={(e) => {
                            const newItems = [...items];
                            // Create a deep copy of the item
                            newItems[index] = {
                                ...newItems[index],
                                value: e.target.value,
                            };
                            onChange(newItems);
                        }}
                    />
                </div>
                <div className="col">
                    <button
                        className="mt-10 btn p-0"
                        onClick={() =>
                            onChange(items.filter((_, i) => i !== index))
                        } // Remove the item at index
                    >
                        <i
                            className="fa-solid fa-xmark"
                            style={{ color: "red" }}
                        ></i>
                    </button>
                </div>
            </div>
        ))}
        <button
            className="btn btn-sm btn-success"
            onClick={() => onChange([...items, { title: "", value: "" }])}
        >
            افزودن
        </button>
    </div>
);

// FormItemSettings Component
export const FormItemSettings = ({ id, type, title, value, required }) => {
    const [items, setItem] = useState(value);
    const [newTitle, setNewTitle] = useState(title || "");
    const [newRequired, setNewRequired] = useState(required || false);

    // Handle changes for the items (Repeater component)
    const onChange = (newItems) => {
        setItem(newItems);
    };

    // Handle changes for the title input
    const titleOnChange = (value) => {
        setNewTitle(value);
    };

    // Handle changes for the required checkbox
    const requiredOnChange = (value) => {
        setNewRequired(value);
    };

    useEffect(() => {
        if (type === "html") {
            var editor = ace.edit("code-editor");
            editor.setTheme("ace/theme/clouds");
            // editor change
            editor.getSession().on("change", function () {
                var code = editor.getValue();
                onChange(code);
            });
        }
    }, []);


    return (
        <>
            <div className="modal-body">
                <div className="row">
                    {type !== "image" &&
                    type !== "text" &&
                    type !== "captcha" &&
                    type !== "html" &&
                    type !== "hidden" ? (
                        <div className="col-12 mb-5">
                            <label htmlFor="">عنوان</label>
                            <input
                                type="text"
                                className="form-control"
                                value={newTitle}
                                onChange={(e) => titleOnChange(e.target.value)}
                            />
                        </div>
                    ) : null}
                    {type === "text" ? (
                        <div className="col-12 mb-5">
                            <label htmlFor="">متن</label>
                            <textarea
                                className="form-control"
                                onChange={(e) => onChange(e.target.value)}
                            >
                                {items}
                            </textarea>
                        </div>
                    ) : null}
                    {type === "image" ? (
                        <div className="col-12 mb-5">
                            <label className="form-label">آدرس تصویر</label>
                            <input
                                className="form-control"
                                type="url"
                                onChange={(e) => onChange(e.target.value)}
                                value={items}
                            />
                        </div>
                    ) : null}
                    {type === "image" && items ? (
                        <img
                            src={items}
                            style={{
                                width: "100%",
                                height: "auto",
                                maxHeight: "150px",
                                objectFit: "contain",
                            }}
                        />
                    ) : null}
                    {type === "captcha" ? (
                        <span>این فیلد تنظیمات ندارد</span>
                    ) : null}
                    {type === "html" ? (
                        <div className="mb-2">
                            <label className="form-label ">ویرایشگر کد</label>
                            <div id="code-editor" style="height: 300px">
                                {items}
                            </div>
                        </div>
                    ) : null}
                    {type !== "image" &&
                    type !== "text" &&
                    type !== "captcha" &&
                    type !== "html" &&
                    type !== "hidden" ? (
                        <div className="col-12 mb-5">
                            <div className="form-check form-check-custom form-check-solid">
                                <input
                                    className="form-check-input"
                                    type="checkbox"
                                    checked={newRequired}
                                    onChange={(e) =>
                                        requiredOnChange(e.target.checked)
                                    }
                                    id="flexRadioDefault"
                                />
                                <label
                                    className="form-check-label"
                                    htmlFor="flexRadioDefault"
                                >
                                    اجباری
                                </label>
                            </div>
                        </div>
                    ) : null}
                    {(type === "select" ||
                        type === "radio" ||
                        type === "checkbox") && (
                        <Repeater items={items} onChange={onChange} />
                    )}
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <div>
                    <button
                        type="button"
                        class="btn btn-primary"
                        onClick={(e) =>
                            saveChanges(id, items, newTitle, newRequired)
                        }
                    >
                        ذخیره
                    </button>
                </div>
                <button
                    class="btn btn-danger"
                    onClick={() => removeElement(id)}
                >
                    حذف
                </button>
            </div>
        </>
    );
};

export function GenerateKanbanCard({ data }) {
    const { id, title, assigneeName, startDate, endDate } = data;
    return (
        <div class="kanban-card">
            {" "}
            {/* Add the data-eid attribute here */}
            <span class="kanban-card-title">{title}</span>
            <div class="kanban-card-details">
                {assigneeName && (
                    <div class="kanban-card-assignee">
                        <div>
                            <span>انجام دهنده</span>
                        </div>
                        <div class="kanban-card-assignee-name">
                            {assigneeName}
                        </div>
                    </div>
                )}
                <div class="kanban-card-dates">
                    {startDate && (
                        <div class="kanban-card-date">
                            <div>تاریخ شروع</div>
                            <span class="kanban-card-date-info">
                                {startDate}
                            </span>
                        </div>
                    )}
                    {endDate && (
                        <div class="kanban-card-date">
                            <div>تاریخ پایان</div>
                            <span class="kanban-card-date-info">{endDate}</span>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
