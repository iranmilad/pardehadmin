<?php

namespace App\Http\Controllers\API;

use App\Models\Message;
use App\Models\Session;
use App\Models\MemberList;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionMessageController extends Controller
{
    // متد برای دریافت اطلاعات یک سشن خاص
    public function getSessionDetails($sessionId)
    {
        // دریافت سشن بر اساس ID
        $session = Session::findOrFail($sessionId);

        // بررسی اینکه کاربر عضو این سشن باشد یا خیر
        if (!Auth::user()->sessions->contains($session)) {
            return response()->json([
                'message' => 'Access Denied'
            ], 403); // بازگشت پاسخ دسترسی غیر مجاز
        }

        // دریافت پیام‌ها برای سشن خاص
        $messages = $session->messages()->select('id', 'sender_id', 'message', 'updated_at', 'created_at')->get();

        // محاسبه تاریخ آخرین به‌روزرسانی سشن
        $lastMessage = $messages->sortByDesc('updated_at')->first();
        $lastUpdate = $lastMessage ? Jalalian::fromCarbon($lastMessage->updated_at)->ago() : 'N/A';

        // ساختار اطلاعات سشن
        $sessionInfo = [
            'requester' => $session->user->name, // درخواست‌کننده
            'department' => $session->memberList->title, // بخش مربوطه
            'sentDate' => Jalalian::fromCarbon($session->created_at)->format('Y/m/d (H:i)'), // تاریخ ارسال
            'lastUpdate' => $lastUpdate, // آخرین به‌روزرسانی
            'title' => $session->title, // عنوان تیکت
            'status' => $session->is_active ? 'open' : 'closed', // وضعیت تیکت
        ];

        // لیست پیام‌ها
        $messagesData = $messages->map(function($message) {
            return [
                'sender' => $message->sender->last_name, // ارسال‌کننده
                'date' => Jalalian::fromCarbon($message->created_at)->format('(H:i) Y/m/d'), // تاریخ ارسال
                'body' => $message->message, // متن پیام
                'you' => $message->user_id === Auth::id() // آیا پیام از طرف کاربر است؟
            ];
        });

        // برگرداندن داده‌ها به صورت ساختار JSON
        return response()->json([
            'message' => 'ok',
            'data' => [
                'id' => $session->id,
                'info' => $sessionInfo,
                'messages' => $messagesData
            ]
        ]);
    }

    public function getUserActiveSessions(Request $request)
    {
        // دریافت پارامترهای limit و page از درخواست
        $limit = $request->input('limit', 20); // مقدار پیش‌فرض برای limit: 20
        $page = $request->input('page', 1); // مقدار پیش‌فرض برای page: 1

        // دریافت سشن‌های فعال کاربر با استفاده از صفحه‌بندی
        $activeSessions = Auth::user()->sessions()
            ->where('is_active', true)
            ->paginate($limit, ['*'], 'page', $page);

        // ساختار ریسپانس برای سشن‌های فعال
        $sessions = $activeSessions->map(function($session) {
            // دریافت آخرین پیام سشن
            $lastMessage = $session->messages()->latest()->first();

            return [
                'id' => $session->id,
                'type' => $session->memberList->title, // استفاده از title مدل MemberList
                'title' => $session->title,
                'status' => $session->is_active ? 'open' : 'closed', // وضعیت پیام
                'update' => $lastMessage ? Jalalian::fromCarbon($lastMessage->updated_at)->format('Y/m/d') : 'N/A', // تاریخ آخرین پیام به شمسی
            ];
        });

        // برگرداندن داده‌ها به صورت ساختار JSON همراه با اطلاعات صفحه‌بندی
        return response()->json([
            'message' => 'ok',
            'data' => [
                'totalPages' => $activeSessions->lastPage(), // تعداد صفحات
                'currentPage' => $activeSessions->currentPage(), // صفحه فعلی
                'tickets' => $sessions
            ]
        ]);
    }

    // متد برای ارسال پیام جدید به سشن
    public function sendMessage(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'department' => 'required|string|exists:member_lists,title', // بررسی موجودیت member_list_id
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // بررسی وجود سشن با member_list_id و کاربر فعلی
        $memberList = MemberList::where(["title"=>$request->department])->first(); // پیدا کردن member list بر اساس department
        $session = Session::where('member_list_id', $memberList->id)
                        ->whereHas('user', function($query) {
                            $query->where('user_id', Auth::id());
                        })
                        ->first();

        // اگر سشن وجود ندارد، سشن جدید بسازیم
        if (!$session) {
            $session = new Session();
            $session->member_list_id = $request->department; // اختصاص دادن member_list_id به سشن جدید
            $session->user_id = Auth::id(); // اختصاص دادن user_id به سشن جدید
            $session->title = $request->title; // اختصاص دادن title به سشن جدید
            $session->priority = $request->priority ?? 2;
            $session->save();
        }

        // ایجاد پیام جدید
        $message = new Message();
        $message->session_id = $session->id; // استفاده از ID سشن
        $message->sender_id = Auth::user()->id; // نام کاربر ارسال‌کننده
        $message->message = $request->description; // متن پیام

        $message->save();

        // بازگشت پاسخ موفقیت‌آمیز
        return response()->json([
            'message' => 'ok',
            'data' => [
                'sender' => $message->sender->last_name,
                'date' => Jalalian::fromCarbon($message->created_at)->format('(H:i) Y/m/d'),
                'body' => $message->message,
                'you' => true // زیرا پیام از طرف خود کاربر است
            ]
        ]);
    }

    public function uploadImage(Request $request, $sessionId)
    {
        // بررسی وجود سشن
        $session = Session::findOrFail($sessionId);

        // بررسی اینکه کاربر عضو این سشن باشد یا خیر
        if (!Auth::user()->sessions->contains($session)) {
            return response()->json([
                'message' => 'Access Denied'
            ], 403);
        }

        // اعتبارسنجی فایل ورودی
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // ذخیره فایل در storage/app/public/messages/
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/messages', $fileName);

        // ذخیره پیام با لینک تصویر
        $message = new Message();
        $message->session_id = $session->id;
        $message->sender_id = Auth::id();
        $message->message = ""; // این پیام متنی ندارد، فقط تصویر دارد
        $message->image = str_replace('public/', 'storage/', $filePath);
        $message->save();

        // بازگشت لینک تصویر
        return response()->json([
            'message' => 'ok',
            'data' => [
                'url' => asset($message->image),
                'id' => $message->id
            ]
        ]);
    }



}
