<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.passwords.change');
    }

    public function update(ChangePasswordRequest $request)
    {
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return back();
    }
}
