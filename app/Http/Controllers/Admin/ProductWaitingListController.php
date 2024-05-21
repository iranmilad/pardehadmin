<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductWaitingList;
use Illuminate\Support\Facades\Auth;

class ProductWaitingListController extends Controller
{
    public function addToWaitingList($id)
    {
        // یافتن محصول با استفاده از آیدی
        $product = Product::findOrFail($id);

        // ایجاد یک رکورد جدید در لیست انتظار با اطلاعات محصول و یوزر لاگین شده
        ProductWaitingList::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        // بازگرداندن پیام موفقیت‌آمیز به صفحه مرجع
        return redirect()->back()->with('success', 'محصول به لیست انتظار شما اضافه شد.');
    }

    /**
     * Remove the specified user from the waiting list of the product.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function removeFromWaitingList($productId)
    {

        $userId = Auth::id();
        $product = Product::findOrFail($productId);

        // Check if the user is in the waiting list for the product
        if ($product->isUserInWaitingList($userId)) {
            // Remove the user from the waiting list
            $product->waitingLists()->where(['user_id'=>$userId,'product_id'=>$productId])->delete();

            return redirect()->back()->with('success', 'کاربر با موفقیت از لیست انتظار حذف شد.');
        }

        return redirect()->back()->with('error', 'کاربر مورد نظر در لیست انتظار محصول وجود ندارد.');
    }


}
