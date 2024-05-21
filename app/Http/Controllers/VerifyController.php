<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MobileVerifyRequest;


class VerifyController extends Controller
{

    public function index(MobileVerifyRequest $request){
        // get mobile from request
        $mobile = $request->input('mobile');

        // Check if validation fails
        if ($request->validated()) {
            // If validation is successful, proceed to the verify page
            return view('auth.verify', compact('mobile'));
        } else {
            // If validation fails, redirect to the login page with errors
            return redirect()->route('login')->withErrors($request->errors());
        }
    }

    public function check_verify(MobileVerifyRequest $request) {

    }

}
