<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Check;
use App\Models\Review;
use App\Models\Product;
use App\Traits\Paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserCollection;
use App\Http\Requests\User\storeUserRequest;
use App\Http\Requests\User\updateUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
	use Paginate;

	public function index(Request $request)
	{
        $user= Auth::user();
        $comments = $user->comments;

        if ($request->cookie('favorites')) {
            $favorites=json_decode($request->cookie('favorites'), true);
            $favorites = Product::whereIn('id', $favorites)->get();
        }
        else{
            $favorites = [];
        }

        return view('dashboard.dashboard',compact('user','comments','favorites'));
	}

	public function comments()
	{
        $user= Auth::user();
        $comments = $user->comments;
		return view('dashboard.comments',compact('user','comments'));
	}


    public function userInfo(){
        $user= Auth::user();
        return view('dashboard.user-info',compact('user'));
    }


    public function userInfoUpdate(Request $request){
        $user = Auth::user();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'nationalcode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
        ]);

        // Update the user's information
        $user->update($validatedData);

        // Redirect the user back to the user-info view with a success message
        return redirect()->route('dashboard.user-info')->with('success', 'اطلاعات شما با موفقیت به‌روزرسانی شد.');
    }

    public function orders(){
        $user= Auth::user();

        return view('dashboard.orders',compact('user'));
    }

    public function order($id){
        $user= Auth::user();
        $order = $user->orders()->where('id',$id)->first();

        return view('dashboard.order',compact('user','order'));
    }



    public function review(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'text' => 'nullable|string',
            'quality' => 'nullable|integer',
            'performance' => 'nullable|integer',
            'design' => 'nullable|integer',
            'price' => 'nullable|integer',
            'ease_of_use' => 'nullable|integer',
            'product_id' => 'required|integer',
        ]);
        $user= Auth::user();

        //get all image load in storeAs as path
        $imagePath= 'public/uploads/customers/reviews/'.$user->id."/".$validatedData['product_id'];
        $images = $this->getCustomerUploadedImages($imagePath);

        // Create a new review instance
        $review = new Review;
        $review->title =$user->fullName;
        $review->text = $validatedData['text'] ?? "بدون نظر";
        $review->rating = ($validatedData['quality']+ $validatedData['performance']+$validatedData['design']+$validatedData['price']+$validatedData['ease_of_use'])/5;
        $review->name = $user->fullName;
        $review->quality = $validatedData['quality'];
        $review->performance = $validatedData['performance'];
        $review->design = $validatedData['design'];
        $review->price = $validatedData['price'];
        $review->ease_of_use = $validatedData['ease_of_use'];
        $review->user_id = $user->id;
        $review->images = json_encode($images,true);
        $review->product_id = $validatedData['product_id'];

        // Save the review to the database
        $review->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد');
    }

    public function changePass(){

        $user= Auth::user();

        return view('dashboard.changepass',compact('user'));
    }

    public function setNewPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'currentpass' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Get the current authenticated user
        $user = Auth::user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->currentpass, $user->password)) {
            return redirect()->back()->withErrors(['currentpass' => 'رمز عبور فعلی اشتباه است']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'رمز عبور با موفقیت تغییر یافت.');
    }

    public function notifications(){
        $user = Auth::user();
        return view('dashboard.notifications',compact('user'));
    }

    public function favorites(Request $request){
        $user = Auth::user();
        if ($request->cookie('favorites')) {
            $favorites=json_decode($request->cookie('favorites'), true);
            $favorites = Product::whereIn('id', $favorites)->get();
        }
        else{
            $favorites = [];
        }

        return view('dashboard.favorites',compact('user','favorites'));
    }

    public function checks(){

        $user = Auth::user();

        $today = Carbon::now();

        // Get all checks for the authenticated user
        $checks = $user->checks()->get();

        // Calculate the total received amount
        $totalReceived = $checks->sum('amount');

        // Calculate the total pending amount
        $totalPending = $checks->where('payment_status', 'unpaid')->sum('amount');

        $totalReceived = $totalReceived -  $totalPending;
        // Count the total number of checks
        $totalChecks = $checks->count();

        return view('dashboard.checks', compact('user','today','checks', 'totalReceived', 'totalPending', 'totalChecks'));

    }

    public function paymentDeadLine(){
        $user = Auth::user();
        $today = Carbon::now();

        // Retrieve all credits
        $credits = $user->credits()->orderBy('due_date','desc')->get();

        // Pass the credits data to the view
        return view('dashboard.payment-deadline',compact('user','credits','today'));
    }

    public function invoice(){
        $user = Auth::user();
        return view('dashboard.invoice',compact('user'));
    }


    private function getCustomerUploadedImages($imagePath){
        // بررسی وجود مسیر مورد نظر
        if (Storage::exists($imagePath)) {

            // دریافت تمام فایل‌های موجود در مسیر
            $files = Storage::files($imagePath);

            // ایجاد یک آرایه برای نگهداری آدرس‌های فایل‌ها
            $imageUrls = [];

            // بررسی هر فایل و افزودن آدرس آن به آرایه
            foreach ($files as $file) {
                // ایجاد آدرس مربوط به فایل
                $url = Storage::url($file);

                // اضافه کردن آدرس به آرایه
                $imageUrls[] = $url;
            }
        }
        else {
            // اگر مسیر وجود نداشته باشد، آرایه را خالی می‌کنیم
            $imageUrls = [];
        }
        return $imageUrls;
    }


}


