<?php

namespace App\Http\Controllers\Auth\Mail;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailConfirmController extends Controller
{
    public function confirmEmail(User $user)
    {
        Auth::login($user->confirmEmail());
        return view('home');
    }
}
