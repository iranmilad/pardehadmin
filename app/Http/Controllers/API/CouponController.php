<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function submitCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();
        $discount = DiscountCode::where('code', $request->code)->first();

        if (!$discount) {
            return response()->json(['error' => 'کد تخفیف نامعتبر است.'], 422);
        }

        if ($discount->is_used) {
            return response()->json(['error' => 'این کد تخفیف قبلاً استفاده شده است.'], 422);
        }

        if ($discount->usage_limit && $discount->usage_count >= $discount->usage_limit) {
            return response()->json(['error' => 'این کد تخفیف به حد نصاب استفاده رسیده است.'], 422);
        }

        if ($discount->discount_expire_end && Carbon::now()->greaterThan($discount->discount_expire_end)) {
            return response()->json(['error' => 'مدت اعتبار این کد تخفیف به پایان رسیده است.'], 422);
        }

        $order = Order::where('user_id', $user->id)->whereNull('status')->first();

        if (!$order) {
            return response()->json(['error' => 'سفارشی برای اعمال تخفیف یافت نشد.'], 422);
        }

        $order->discount_code_id = $discount->id;
        $order->save();

        $discount->increment('usage_count');

        return response()->json(['message' => 'کد تخفیف با موفقیت اعمال شد.', 'order' => $order], 200);
    }
}
