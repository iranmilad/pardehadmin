<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * نمایش لیست علاقه‌مندی‌ها
     */
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('product')->get();

        return view('favorites.index', compact('favorites'));
    }

    /**
     * اضافه کردن محصول به لیست علاقه‌مندی‌ها
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        auth()->user()->favorites()->create([
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'محصول به لیست علاقه‌مندی‌ها اضافه شد.');
    }

    /**
     * حذف محصول از لیست علاقه‌مندی‌ها
     */
    public function destroy($id)
    {
        $favorite = auth()->user()->favorites()->findOrFail($id);
        $favorite->delete();

        return back()->with('success', 'محصول از لیست علاقه‌مندی‌ها حذف شد.');
    }
}
