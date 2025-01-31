<?php

namespace App\Http\Controllers\API;

use App\Models\SupplierReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierReviewController extends Controller
{
    public function getSupplierComments($id, Request $request)
    {
        // دریافت تأمین‌کننده
        $supplier = Supplier::findOrFail($id);

        // دریافت پارامترهای صفحه‌بندی
        $limit = $request->input('limit', 15);
        $page = $request->input('page', 1);

        // دریافت نظرات مربوط به تأمین‌کننده
        $reviews = SupplierReview::where('supplier_id', $supplier->id)
            ->with(['user', 'supplier'])
            ->paginate($limit, ['*'], 'page', $page);

        // محاسبه میانگین امتیاز
        $averageRating = round(SupplierReview::where('supplier_id', $supplier->id)->avg('rating'), 1);
        $totalCount = SupplierReview::where('supplier_id', $supplier->id)->count();

        // تبدیل نظرات به فرمت مناسب برای ریسپانس
        $comments = $reviews->map(function ($review) {
            return [
                'name' => $review->user->name ?? 'کاربر مهمان',
                'date' => $review->date_shamsi,
                'rating' => (string) $review->rating,
                'comment' => $review->text,
                'status' => $review->status,
                'product' => [
                    'image' => '/static/image/1.812d88ff.webp', // مقدار پیش‌فرض
                    'title' => 'نام محصول', // مقدار پیش‌فرض
                ],
            ];
        });

        // خروجی نهایی
        return response()->json([
            'message' => 'ok',
            'data' => [
                'rating' => (string) $averageRating,
                'count' => count($comments),
                'total' => $totalCount,
                'comments' => $comments,
            ]
        ]);
    }
}
