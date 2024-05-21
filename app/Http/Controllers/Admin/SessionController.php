<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function store(Request $request)
    {
        // ایجاد جلسه
        $session = new Session();
        $session->title = $request->title;
        $session->priority = $request->priority;
        $session->member_list_id = $request->department;
        $session->user_id = Auth::id(); // ذخیره شناسه کاربر کنونی
        $session->save();

        // ثبت پیام
        $message = new Message();

        $message->message = $request->message;
        $message->image = $request->file ?? null; // اینجا فایل را بررسی و ذخیره کنید
        $message->session_id = $session->id; // انتساب جلسه به پیام
        $message->sender_id = Auth::id(); // ذخیره شناسه کاربر کنونی
        $message->save();

        return redirect()->back()->with('success', 'پیام با موفقیت ارسال شد.');
    }


    public function messages($id, Request $request){
        // احراز هویت کاربر
        $user = $request->user();

        // بررسی اینکه آیا کاربر لاگین کرده یا خیر
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $session = Session::where('id', $id)->first();
        $session_msgs = $session->messages;
        $messages=[];

        foreach ($session_msgs as $text) {
            $message = (object) $text;
            $messages[] = [
                'id' => $message->id,
                'message' =>  $message->message,
                'created_at' => $message->create_at,
                'files' => ($message->image!= null) ? [$message->image] : [],
                'you' => ($message->sender_id == $user->id) ? true : false,
            ];
        };

        $message = [
            'id' => $id,
            'sender' =>  $session->user->fullName,
            'priority' =>  $session->priority,
            'title' =>  $session->title,
            'timestamp' => count($messages),
            'messages' => $messages,
        ];

        return response()->json(['message' => $message]);

    }


    public function save(Request $request){
        $user = $request->user();
        $id = $request->session;

        $session = Session::where('id', $id)->first();
        //save message in message model
        $message = new Message();

        $message->message = $request->message;
        $message->image = $request->file ?? null; // اینجا فایل را بررسی و ذخیره کنید
        $message->session_id = $session->id; // انتساب جلسه به پیام
        $message->sender_id = $user->id; // ذخیره شناسه کاربر کنونی
        $message->save();
        return redirect()->back()->with('success', 'پیام با موفقیت ارسال شد.');
    }

    public function timestamp(Request $request,$id){

        $user = $request->user();
        $session = Session::where('id', $id)->first();
        $session_msgs = $session->messages;
        $messages=[];

        foreach ($session_msgs as $text) {
            $message = (object) $text;
            $messages[] = [
                'id' => $message->id,
                'message' =>  $message->message,
                'created_at' => $message->create_at,
                'files' => ($message->image!= null) ? [$message->image] : [],
                'you' => ($message->sender_id == $user->id) ? true : false,
            ];
        };

        $timestamp=count($messages);

        return response()->json(array("timestamp" => $timestamp));

    }

}
