<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function index(Request $request){
        if ($request->cookie('favorites')) {
            $favorites=json_decode($request->cookie('favorites'), true);
            $products = Product::whereIn('id', $favorites)->get();
        }
        else{
            //$products = Product::all();
            $products = [];
        }

        return view('favorites', compact('products'));

    }

    public function storeWishlist(Request $request,$id)
    {
        // خواندن مقدار wishlist از کوکی
        if ($request->cookie('favorites')) {

            $favorites=json_decode($request->cookie('favorites'), true);
            // چک کردن آیا مقدار مورد نظر در آرایه وجود دارد یا خیر
            if (!in_array($id, $favorites)) {
                // اضافه کردن مقدار جدید به آرایه wishlist
                $favorites[] = $id;
            }


        }
        else{
            $favorites[] = $id;
        }

        return redirect()->back()->with('success', 'محصول با موفقیت به لیست علاقه‌مندی‌ها اضافه شد.')->cookie('favorites', json_encode($favorites));;
    }

    public function delete(Request $request,$id){
        // خواندن مقدار wishlist از کوکی
        if ($request->cookie('favorites')) {
            $favorites = json_decode($request->cookie('favorites'), true);
            // چک کردن آیا مقدار مورد نظر در آرایه وجود دارد یا خیر
            if (in_array($id, $favorites)) {
                // حذف مقدار مورد نظر از آرایه wishlist
                $favorites = array_diff($favorites, [$id]);
            }
        }

        return redirect()->back()->with('success', 'محصول با موفقیت از لیست علاقه‌مندی‌ها حذف شد.')->cookie('favorites', json_encode($favorites));

    }
}
