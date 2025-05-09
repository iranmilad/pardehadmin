<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{

    public function register(Request $request): JsonResponse
    {
        try {
            // اعتبارسنجی ورودی‌ها
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'family' => 'required|string|max:255',
                'nationalCode' => 'required|string|size:10|unique:users,national_code',
                'mobile' => 'required|string|regex:/^09\d{9}$/|unique:users,mobile',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطای اعتبارسنجی',
                'errors' => $e->errors(), // ارسال خطاهای اعتبارسنجی به‌صورت آرایه
            ], 422);
        }

        // بررسی وجود کاربر با شماره موبایل یا کد ملی
        if (User::where('mobile', $validatedData['mobile'])
                ->orWhere('national_code', $validatedData['nationalCode'])
                ->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'این کاربر از قبل وجود دارد',
            ], 400);
        }

        // ایجاد کاربر جدید
        $user = User::create([
            'first_name' => $validatedData['name'],
            'last_name' => $validatedData['family'],
            'national_code' => $validatedData['nationalCode'],
            'mobile' => $validatedData['mobile'],
            'password' => Hash::make('default_password'), // رمز عبور پیش‌فرض
            'active' => 0,
        ]);

        // تولید توکن JWT
        try {
            $token = JWTAuth::fromUser($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ["code"=>'خطا در تولید توکن.'],
                ], 500);
        }

        // Return JSON response with token
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            "userId" => $user->id,
            'token' => $token,
        ], 201);
    }


    public function verifyregister(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $validatedData = $request->validate([
            'mobile' => 'required|string|regex:/^\d{10,15}$/',
            'code' => 'required|string|size:4',
        ]);

        $phoneNumber = $validatedData['mobile'];
        $otp = $validatedData['code'];

        // بررسی وجود شماره موبایل در دیتابیس کاربران
        $user = User::where('mobile', $phoneNumber)->first();

        if (!$user) {
            return response()->json([
                'error' => ["code"=>'کاربری با این شماره موبایل یافت نشد'],
            ], 404);
        }

        // بررسی OTP در دیتابیس
        $otpRecord = Otp::where('phone_number', $phoneNumber)
            ->where('otp', $otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'error' => ["code"=>'کد وارد شده اشتباه است'],
            ], 401);
        }

        // حذف OTP پس از استفاده
        $otpRecord->delete();


        $user->active= 1;
        $user->save();

        return response()->json([
            'message' => 'ok'
        ]);
    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }

        $success = $this->respondWithToken($token);

        return $this->sendResponse($success, 'User login successfully.');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $success = auth()->user();

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->sendResponse([], 'Successfully logged out.');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }


    public function verifyOtp(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $validatedData = $request->validate([
            'mobile' => 'required|string|regex:/^\d{10,15}$/',
            'code' => 'required|string|size:4',
        ]);

        $phoneNumber = $validatedData['mobile'];
        $otp = $validatedData['code'];

        // بررسی وجود شماره موبایل در دیتابیس کاربران
        $user = User::where('mobile', $phoneNumber)->first();

        if (!$user) {
            return response()->json([
                'error' => ["code"=>'کاربری با این شماره موبایل یافت نشد'],
            ], 404);
        }

        // بررسی OTP در دیتابیس
        $otpRecord = Otp::where('phone_number', $phoneNumber)
            ->where('otp', $otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'error' => ["code"=>'کد وارد شده اشتباه است'],
            ], 401);
        }

        // حذف OTP پس از استفاده
        $otpRecord->delete();

        // تولید توکن JWT
        try {
            $token = JWTAuth::fromUser($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ["code"=>'خطا در تولید توکن.'],
            ], 500);
        }

        // آماده‌سازی اطلاعات کاربر برای پاسخ
        $userData = [
            'id' => $user->id,
            'name' => $user->first_name,
            'familyName' => $user->last_name,
            'roleLabel' => $user->role->display_name,
            'role' => $user->role->title,
            'nationalCode' => $user->national_code,
            'mobile' => $user->mobile,
            'birthday' => $user->birthday ?? null, // پیش‌فرض اگر تاریخ تولد ثبت نشده باشد
            'email' => $user->email,
            'status' => $user->active
        ];

        return response()->json([
            'message' => 'Login successful',
            'user' => $userData,
            'token' => $token,
            'maxAge' => '2592000', // ۳۰ روز
        ]);
    }

    public function sendOtp(Request $request)
    {
        // اعتبارسنجی شماره موبایل
        $validatedData = $request->validate([
            'mobile' => 'required|string|regex:/^\d{10,15}$/',
        ]);

        $phoneNumber = $validatedData['mobile'];

        // بررسی وجود شماره موبایل در دیتابیس کاربران
        $user = User::where('mobile', $phoneNumber)->first();

        if (!$user) {
            return response()->json([
                'error' => ["code"=>'کاربری با این شماره موبایل یافت نشد'],
            ], 404);
        }

        // تولید OTP
        $otp = app()->environment('production') ? rand(1000, 9999) : 2020;

        // ذخیره OTP در دیتابیس
        $sms = Otp::updateOrCreate(
            ['phone_number' => $phoneNumber],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5), // اعتبار ۵ دقیقه‌ای
            ]
        );

        // اگر محیط production نباشد، از ارسال پیامک صرف‌نظر شود
        if (!app()->environment('production')) {
            return response()->json([
                'message' => 'SMS code generated successfully',
                'smsId' => $sms->id ?? 1,
                "smsCode" => $otp,
            ]);
        }

        // ارسال OTP با API پیامک
        $apiUrl = 'https://sms-provider.com/api/send';
        $apiKey = config('services.sms.api_key');

        try {
            Http::withOptions([
                'verify' => false,
            ])->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'to' => $phoneNumber,
                'message' => "رمز یکبار مصرف شما: $otp",
            ]);

            return response()->json([
                'message' => 'SMS code generated successfully',
                'smsId' => $sms->id ?? 1,
                "smsCode" => $otp,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ["code"=>'خطا در ارسال پیامک.'],
            ], 500);
        }
    }


    public function verifyToken(Request $request)
    {
        try {
            // دریافت توکن از درخواست
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Token not provided',
                ], 401);
            }

            // اعتبارسنجی توکن و دریافت اطلاعات کاربر
            $payload = JWTAuth::getPayload($token);

            return response()->json([
                'valid' => true,
                'user' => [
                    'id' => $payload->get('sub'), // شناسه کاربر
                    'role' => $payload->get('role'), // نقش کاربر (در صورت وجود در توکن)
                    'exp' => $payload->get('exp'), // زمان انقضای توکن
                ],
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Token has expired',
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Token is invalid',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'An error occurred while verifying the token',
            ], 500);
        }
    }
}
