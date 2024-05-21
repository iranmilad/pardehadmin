<?php

namespace App\Http\Controllers\Auth\Mail;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(){
        return view('auth.reset');
    }

    /**
     * Reset the user's password.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Find the user based on the token
        $user = User::where('email', $request->email)->first();

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect the user after resetting the password
        return redirect()->route('login')->with('success', 'رمز عبور شما با موفقیت تغییر یافت.');
    }

}
