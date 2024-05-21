<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{

    public Function index(Request $request){
        return view('contact-us');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');


        Mail::to(config('mail.from.address'))->send(new ContactFormMail($name, $email, $phone, $subject, $message));

        return redirect()->back()->with('success', 'پیام شما با موفقیت ارسال شد!');
    }
}
