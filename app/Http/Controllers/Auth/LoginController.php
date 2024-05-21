<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{


    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function  index(){

        return view('auth.login');
    }
    public function login()
    {
        $mobile = request("mobile");

        $user = User::where('mobile', $mobile)->first(['id', 'password', 'active']);

        if (!$user) {
            return redirect()->route('login')->withErrors("کاربری با این شماره ثبت نام نشده است.");
        }

        if (!$user->active) {
            return redirect()->route('login')->withErrors("حساب کاربری شما غیر فعال شده است.");
        }

        if (!Hash::check(request('password'), $user->password)) {
            return redirect()->route('login')->withErrors("اطلاعات ورود اشتباه می باشد.");
        }

        // Save password in a cookie if the 'remember' checkbox is checked
        if (request()->has('remember')) {
            $this->savePasswordInCookie($user->id, request('password'));
        }

        $token = auth()->login($user);

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

        Cookie::queue($cookieName, $cookieValue, 30 * 24 * 60);

    }


    public function logout()
    {
        // // Remove remember password cookie if exists
        // if (Cookie::has('remember_password')) {
        //     Cookie::forget('remember_password');
        // }

        auth()->logout();

        return redirect('/'); // Redirect to home or any desired page after logout
    }
}
