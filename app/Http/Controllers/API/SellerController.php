<?php
namespace App\Http\Controllers\API;


use App\Models\Supplier; // فرض بر این است که مدل Supplier برای فروشنده دارید

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function getSellerInfo($id)
    {
        // دریافت اطلاعات فروشنده بر اساس شناسه
        $seller = Supplier::findOrFail($id);

        // ساختار داده‌ها
        $response = [
            'message' => 'ok',
            'data' => [
                'name' => $seller->name, // نام فروشنده
                'province' => $seller->user->province, // استان فروشنده
                'rating' => $seller->rating, // امتیاز فروشنده
                'userComments' => $seller->reviews->count(), // تعداد نظرات کاربران
                'image' => $seller->user->avatar ?? '', // تصویر فروشنده
                'others' => [
                    [
                        'label' => 'محل ارسال',
                        'value' => $seller->delivery_areas, // محل ارسال
                    ],
                    [
                        'label' => 'زمان تحویل',
                        'value' => "10 روز", // زمان تحویل
                    ],
                    [
                        'label' => 'گارانتی',
                        'value' => "", // گارانتی
                    ],
                    [
                        'label' => 'روش‌های پرداخت',
                        'value' => "", // روش‌های پرداخت
                    ],
                    [
                        'label' => 'خدمات پس از فروش',
                        'value' => "", // خدمات پس از فروش
                    ],
                    [
                        'label' => 'امکان بازگشت کالا',
                        'value' => "", // امکان بازگشت کالا
                    ]
                ]
            ]
        ];

        return response()->json($response);
    }
}
