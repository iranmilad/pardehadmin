<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\VerificationCode\VerificationCode;

class AuthController extends Controller
{
    use VerificationCode;
    public function showRegistrationForm()
    {
        return view('auth.registration');
    }


    public function showMobileVerificationForm()
    {
        return view('auth.mobile_verification');
    }

    public function registerSubmit(Request $request)
    {
        // Add your validation logic here
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',

            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate gu_id using the createVerificationCode method
        $gu_id = $this->createVerificationCode($request->input('mobile'))->gu_id;

        // Add your registration logic here (e.g., store user data)
        User::query()->create([
            "first_name"=>$request->input('first_name'),
            "last_name"=>$request->input('last_name'),
            "mobile"=>$request->input('mobile'),
            "password"=>Hash::make($request->input('password')),
        ]);

        // Redirect to the verification form
        return redirect()->route('verify.form', ['id' => $gu_id,'mobile' => $request->input('mobile')]);
    }

    public function showVerificationForm($id,$mobile)
    {
        return view('auth.verify')->with(['id' => $id,'mobile'=>$mobile]);
    }

    public function verifyCode(Request $request)
    {

        try {

            $this->verifySmsCode($request);
            // Verification successful, you can customize the redirect route
            return redirect()->route('login');
        }
        catch (\Exception $e) {
            // Verification failed, handle the error and redirect back

            return back()->withErrors($e->getMessage());
        }
    }

	public function edit(Request $request){

		$user=auth()->user();

		$user->update($request->only(['first_name','last_name']));

		return $this->responseJson("اطلاعات شما با موفقیت ویرایش شد.",null,201);
	}

    public function changePassword(Request $request){

		$user=auth()->user();

		if(!Hash::check($request->input('current_password'),$user->password)){
            return  $this->responseJson("رمز عبور فعلی اشتباه می باشد.",null,401,"error");
         }

		$user->password=Hash::make($request->input('password'));
		$user->save();

		return $this->responseJson("رمز عبور شما با موفقیت تغییر یافت.",null,201);
	}

    public function resendVerifyCode(Request $request)
    {

        $mobile=$request->input('mobile');
        // Generate gu_id using the createVerificationCode method
        $gu_id = $this->createVerificationCode($mobile)->gu_id;
        $this->showVerificationForm($gu_id,$mobile);
        // Output the JSON data to the browser
        echo json_encode([
            "success" => true,
            "message" => "new code sended",
            "gu_id" => $gu_id
        ]);
    }




    public function MobileVerificationSubmit(Request $request)
    {

        $mobile = $request->input('mobile');
        // find user with this mobile number exist or not
        if (!User::whereMobile($mobile)->exists()) {
            log::error('کاربری با این شماره یافت نشد');
            // go to route name  witherror mobile orpass error message
            return back()->withErrors(['mobile'=>'کاربری با این شماره یافت نشد']);

        }
        $oneTimePassword = $this->oneTimePassword($request->input('mobile'));
        $id = $oneTimePassword->gu_id;

        // Redirect to the verification form
        return redirect(route('remember.code.form',['id' => $id,'mobile'=>$mobile]));
    }


    public function rememberCodeValidate(Request $request)
    {
        try {

            $this->verifySmsCode($request);
            // Verification successful, you can customize the redirect route
            return redirect()->route('dashboard.changepass');
        }
        catch (\Exception $e) {
            // Verification failed, handle the error and redirect back
            Log::error($e->getMessage());
            return back()->withErrors(["code"=>$e->getMessage()]);
        }
    }


    public function ShowRememberCodeForm($id,$mobile)
    {
        return view('auth.rememberVerify')->with(['id' => $id,'mobile'=>$mobile]);
    }
}
