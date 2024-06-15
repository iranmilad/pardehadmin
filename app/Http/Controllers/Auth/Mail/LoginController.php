<?php

namespace App\Http\Controllers\Auth\Mail;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input("email");

        $user = User::where('email', $email)->first(['id', 'password', 'active', 'role_id']);

        if (!$user) {
            return redirect()->route('login')->withErrors("کاربری با این ایمیل ثبت نام نشده است.");
        }

        if (!$user->active) {
            return redirect()->route('login')->withErrors("حساب کاربری شما غیر فعال شده است.");
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('login')->withErrors("اطلاعات ورود اشتباه می باشد.");
        }

        if (!$user->isAdmin()) {
            return redirect()->route('login')->withErrors("شما اجازه ورود به این سیستم را ندارید.");
        }

        // Save password in a cookie if the 'remember' checkbox is checked
        if ($request->has('remember')) {
            $this->savePasswordInCookie($user->id, $request->input('password'));
        }

        $token = Auth::login($user);

        if ($token) {
            // Authentication successful, redirect to the intended page or home
            return redirect($this->redirectTo);
        } else {
            // Authentication failed
            return redirect()->route('login')->withErrors("Unable to generate authentication token.");
        }
    }

    // New method to save password in a cookie
    private function savePasswordInCookie($userId, $password)
    {
        $cookieName = 'remember_password';
        $cookieValue = encrypt(['user_id' => $userId, 'password' => $password]);

        Cookie::queue($cookieName, $cookieValue, 30 * 24 * 60); // 30 days
    }

    public function logout()
    {
        // Remove remember password cookie if exists
        if (Cookie::has('remember_password')) {
            Cookie::forget('remember_password');
        }

        Auth::logout();

        return redirect('/'); // Redirect to home or any desired page after logout
    }
}
