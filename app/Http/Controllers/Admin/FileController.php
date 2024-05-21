<?php

namespace App\Http\Controllers\Admin;


use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function upload(Request $request)
    {
        // یا برای دریافت هدرها:
        $headers = (object)$request->header();

        if ($request->hasFile('file')) {
            if($request->hasHeader('message')){

                $sesstion_id = $headers->message[0];
                $message = new Message();


                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('public/uploads', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
                $file->move(public_path('uploads'), $fileName);

                $uploadedFiles = $filePath;

                $message->message = "";
                $message->image = "\\". 'uploads\\'.$fileName ?? null; // اینجا فایل را بررسی و ذخیره کنید
                $message->session_id = $sesstion_id; // انتساب جلسه به پیام
                $message->sender_id = Auth::id(); // ذخیره شناسه کاربر کنونی
                $message->save();

                return response()->json(['url' =>"\\". 'uploads\\'.$fileName,'date' => $message->create_at], 200);
            }
            elseif($request->hasHeader('Order') and $request->hasHeader('Productid')){

                $order_id = $headers->order;
                $product_id = $headers->productid;


                $user= Auth::user();

                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('public/uploads/customers/reviews/'.$user->id."/".$product_id[0], $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
                $file->move(public_path('uploads/customers/reviews/'.$user->id.'/'.$product_id[0]), $fileName);
                $uploadedFiles = $filePath;

                return response()->json(['url' =>'/uploads/customers/reviews/'.$user->id."/".$product_id[0]."/".$fileName], 200);
            }
        }
        else {
            return response()->json(['success' => false, 'message' => 'خطا در بارگذاری فایل']);
        }

    }

    public function remove(Request $request)
    {
        $id = $request->input('id');
        // اینجا کدی برای حذف فایل از سیستم فایل شما قرار بگیرد
        // مثال:
        Storage::delete('uploads/' . explode("-",$id)[2]);

        // در صورت موفقیت آمیز بودن حذف فایل
        return response()->json(['success' => true, 'message' => 'فایل با موفقیت حذف شد']);
    }


}
