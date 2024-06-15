<?php

namespace App\Http\Controllers\Auth\Mail;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class ResetPasswordController extends Controller
{
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm()
    {
        return view('auth.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // با استفاده از توکن، کاربر مربوطه را پیدا می‌کنیم
        $user = User::where('email', $request->email)->first();

        // رمز عبور کاربر را به‌روزرسانی می‌کنیم
        $user->password = Hash::make($request->password);
        $user->save();

        // پس از تغییر رمز عبور، کاربر را به مسیر لاگین هدایت می‌کنیم
        return redirect()->route('login')->with('success', 'رمز عبور شما با موفقیت تغییر یافت.');
    }
}
