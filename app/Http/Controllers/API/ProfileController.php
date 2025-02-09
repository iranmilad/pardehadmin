<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        // Get the authenticated user
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated.',
                'data' => null,
            ], 401);
        }

        // Format the data
        $data = [
            'id' => $user->id,
            'name' => $user->first_name,
            'familyName' => $user->last_name,
            'userType' => $user->role->title,
            'userTypeLabel' => $user->role->display_name,
            'nationalCode' => $user->national_code,
            'mobile' => $user->mobile,
            'birthday' => $this->gregorianToJalalian($user->birthday), // Assuming 'birthday' exists
            'email' => $user->email,
            'status' => $user->active ? 'active' : 'inactive',
        ];

        return response()->json([
            'message' => 'ok',
            'data' => $data,
        ]);
    }

    /**
     * Convert date from Gregorian to Jalali (Shamsi).
     *
     * @param  string|null  $date
     * @return string|null
     */
    private function gregorianToJalalian($date)
    {
        if (!$date) {
            return null;
        }

        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($date);

        // Convert to Jalali (Shamsi)
        return Jalalian::fromCarbon($gregorianDate)->format('Y/m/d');
    }


    public function edit(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated.',
                'data' => null,
            ], 401);
        }

        // Validate the request
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'familyName' => 'nullable|string|max:255',
            'nationalCode' => [
                'nullable',
                'string',
                'size:10',
                Rule::unique('users', 'national_code')->ignore($user->id),
            ],
            'mobile' => [
                'nullable',
                'string',
                'regex:/^09[0-9]{9}$/',
                Rule::unique('users', 'mobile')->ignore($user->id),
            ],
            'birthday' => 'nullable|date', // Expects a Gregorian date
            'email' => 'nullable|email|max:255',
        ]);

        // Update user information
        $user->update([
            'first_name' => $validatedData['name'] ?? $user->first_name,
            'last_name' => $validatedData['familyName'] ?? $user->last_name,
            'national_code' => $validatedData['nationalCode'] ?? $user->national_code,
            'mobile' => $validatedData['mobile'] ?? $user->mobile,
            'birthday' => $validatedData['birthday'] ?? $user->birthday,
            'email' => $validatedData['email'] ?? $user->email,
        ]);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'data' => $user,
        ]);
    }

}
