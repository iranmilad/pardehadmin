<?php

namespace App\Http\Controllers\API;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        // گرفتن کاربر لاگین شده
        $user = $request->user();

        // گرفتن لیست محصولات موردعلاقه کاربر
        $favorites = $user->favorites()->with('product')->get();

        // تبدیل داده‌ها به فرمت موردنظر
        $data = $favorites->map(function ($favorite) {
            $product = $favorite->product;

            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'regularPrice' => $product->regular_price,
                'discountedPrice' => $product->discounted_price,
                'discountPercent' => $product->discount_percentage . '%',
                'image' => $product->image,
            ];
        });

        return response()->json([
            'message' => 'ok',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // اعتبارسنجی درخواست
        $validated = $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        $user = $request->user(); // دریافت کاربر لاگین شده
        $productId = $validated['id'];

        $newFavorite = null;

        // بررسی وجود علاقه‌مندی
        $favoriteExists = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        if (!$favoriteExists) {
            // اضافه کردن محصول به علاقه‌مندی‌ها
            $favorite = Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);

            // بارگذاری محصول تازه اضافه‌شده
            $newFavorite = $favorite->load('product');
        }

        // بارگذاری لیست علاقه‌مندی‌ها
        $favorites = Favorite::where('user_id', $user->id)
            ->with('product') // بارگذاری اطلاعات محصول
            ->get()
            ->map(function ($favorite) {
                $product = $favorite->product;

                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->id, // می‌توانید مقدار اسلاگ واقعی را جایگزین کنید
                    'regularPrice' => $product->price,
                    'discountedPrice' => $product->sale_price,
                    'discountPercent' => $product->discount_percentage . '%',
                    'image' => $product->img,
                ];
            });

        // آماده‌سازی ریسپانس
        $response = [
            'message' => 'ok',
            'data' => $favorites,
        ];

        // اضافه کردن محصول تازه اضافه‌شده به پاسخ (در صورت وجود)
        if ($newFavorite) {
            $response['newFavorite'] = [
                'id' => $newFavorite->product->id,
                'title' => $newFavorite->product->title,
                'slug' => $newFavorite->product->id,
                'regularPrice' => $newFavorite->product->price,
                'discountedPrice' => $newFavorite->product->sale_price,
                'discountPercent' => $newFavorite->product->discount_percentage . '%',
                'image' => $newFavorite->product->img,
            ];
        }

        return response()->json($response);
    }


    public function destroy(Request $request)
    {
        // اعتبارسنجی درخواست
        $validated = $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $productId = $validated['id'];

        // پیدا کردن و حذف علاقه‌مندی
        Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        // بازگرداندن لیست علاقه‌مندی‌های به‌روز شده
        $favorites = Favorite::where('user_id', $user->id)
            ->with('product') // بارگذاری اطلاعات محصول
            ->get()
            ->map(function ($favorite) {
                $product = $favorite->product;

                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->id, // می‌توانید مقدار اسلاگ واقعی را جایگزین کنید
                    'regularPrice' => $product->price,
                    'discountedPrice' => $product->sale_price,
                    'discountPercent' => $product->discount_percentage . '%',
                    'image' => $product->img,
                ];
            });

        return response()->json([
            'message' => 'ok',
            'data' => $favorites,
        ]);
    }



}

