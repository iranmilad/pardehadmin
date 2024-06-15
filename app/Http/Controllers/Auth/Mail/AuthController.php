<?php
namespace App\Http\Controllers\Auth\Mail;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\VerificationCode\VerificationCode;

class AuthController extends Controller
{
    use VerificationCode;

    public function show()
    {
        return view('auth.registration');
    }

    public function showMobileVerificationForm()
    {
        return view('auth.registration');
    }

    public function submit(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:10|max:15|unique:users,mobile',
        ]);

        // Create new user with hashed password
        User::create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('phone'),
        ]);

        // Redirect to the login page with success message
        return redirect()->route('login')->with('success', 'ثبت نام شما با موفقیت انجام شد');
    }

    public function showVerificationForm($id, $mobile)
    {
        return view('auth.verify')->with(['id' => $id, 'mobile' => $mobile]);
    }

    public function verifyCode(Request $request)
    {
        try {
            $this->verifySmsCode($request);
            // Verification successful, you can customize the redirect route
            return redirect()->route('login');
        } catch (\Exception $e) {
            // Verification failed, handle the error and redirect back
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only(['first_name', 'last_name']));
        return $this->responseJson("اطلاعات شما با موفقیت ویرایش شد.", null, 201);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return $this->responseJson("رمز عبور فعلی اشتباه می باشد.", null, 401, "error");
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $this->responseJson("رمز عبور شما با موفقیت تغییر یافت.", null, 201);
    }

    public function resendVerifyCode(Request $request)
    {
        $mobile = $request->input('mobile');
        $gu_id = $this->createVerificationCode($mobile)->gu_id;
        return response()->json([
            "success" => true,
            "message" => "کد جدید ارسال شد",
            "gu_id" => $gu_id
        ]);
    }

    public function MobileVerificationSubmit(Request $request)
    {
        $mobile = $request->input('mobile');
        if (!User::where('mobile', $mobile)->exists()) {
            Log::error('کاربری با این شماره یافت نشد');
            return back()->withErrors(['mobile' => 'کاربری با این شماره یافت نشد']);
        }
        $oneTimePassword = $this->oneTimePassword($mobile);
        $id = $oneTimePassword->gu_id;
        return redirect()->route('remember.code.form', ['id' => $id, 'mobile' => $mobile]);
    }

    public function rememberCodeValidate(Request $request)
    {
        try {
            $this->verifySmsCode($request);
            return redirect()->route('dashboard.changepass');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors(["code" => $e->getMessage()]);
        }
    }

    public function ShowRememberCodeForm($id, $mobile)
    {
        return view('auth.rememberVerify')->with(['id' => $id, 'mobile' => $mobile]);
    }
}
