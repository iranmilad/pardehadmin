<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Session;
use App\Models\Message;
use Morilog\Jalali\Jalalian;

class AccountController extends Controller
{
    public function myAccount(Request $request)
    {
        $user = Auth::user();

        // دریافت تعداد کل سفارشات
        $allOrdersCount = Order::where('user_id', $user->id)->count();

        // دریافت تعداد تیکت‌های کاربر
        $ticketsCount = Session::where('user_id', $user->id)->count();

        // دریافت ۶ سفارش آخر
        $lastOrders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => (string) $order->id,
                    'date' => Jalalian::fromCarbon($order->created_at)->format('Y/m/d'),
                    'status' => $this->translateStatus($order->status),
                    'total' => number_format($order->total_price)
                ];
            });

        // دریافت تمامی وضعیت‌های سفارشات
        $allOrdersStatus = Order::where('user_id', $user->id)
            ->select('id', 'status')
            ->get()
            ->map(function ($order) {
                return [
                    'id' => (string) $order->id,
                    'status' => $this->translateStatus($order->status),
                ];
            });

        // دریافت ۶ موردعلاقه آخر از `Favorite`
        $lastFavorites = Favorite::where('user_id', $user->id)
            ->with('product') // واکشی اطلاعات محصول
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($favorite) {
                $product = $favorite->product;

                if (!$product) {
                    return null; // در صورتی که محصول حذف شده باشد
                }

                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'regularPrice' => $product->price,
                    'discountedPrice' => $product->sale_price,
                    'discountPercent' => $product->discountPercentage,
                    'image' => asset($product->img),
                ];
            })->filter(); // حذف مقدار `null` در صورت نبود محصول

        // دریافت ۶ تیکت آخر کاربر
        $lastTickets = Session::where('user_id', $user->id)
            ->with(['messages' => function ($query) {
                $query->latest()->first();
            }])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($session) {
                $lastMessage = $session->messages->first();
                return [
                    'id' => $session->id,
                    'title' => $session->title,
                    'department' => $session->memberList->title ?? 'نامشخص',
                    'status' => $session->is_active ? 'open' : 'closed',
                    'lastUpdate' => $lastMessage ? Jalalian::fromCarbon($lastMessage->updated_at)->format('Y/m/d H:i') : 'N/A',
                ];
            });

        return response()->json([
            'message' => 'ok',
            'data' => [
                'account_balance' => $user->wallet_balance ?? 0,
                'all_orders' => $allOrdersCount,
                'tickets' => $ticketsCount,
                'all_orders_status' => $allOrdersStatus,
                'orders' => $lastOrders,
                'favorites' => $lastFavorites,
                'last_tickets' => $lastTickets,
            ]
        ]);
    }

    /**
     * ترجمه وضعیت سفارش به فارسی
     */
    private function translateStatus($status)
    {
        $statuses = [
            'pending' => 'در حال بررسی',
            'processing' => 'در حال پردازش',
            'completed' => 'تکمیل شده',
            'canceled' => 'لغو شده',
            'failed' => 'ناموفق'
        ];

        return $statuses[$status] ?? 'نامشخص';
    }

    /**
     * محاسبه درصد تخفیف
     */
    private function calculateDiscountPercent($regularPrice, $discountedPrice)
    {
        if (!$regularPrice || !$discountedPrice || $regularPrice == $discountedPrice) {
            return "0";
        }

        return (string) round((($regularPrice - $discountedPrice) / $regularPrice) * 100);
    }
}
