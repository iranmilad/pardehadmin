<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Credit;
use App\Models\CreditPlan;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_credits';
    }

    public function index(Request $request)
    {
        // ساختن کوئری برای Credit
        $query = Credit::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // جستجو بر اساس شناسه یا نام کاربر
        if ($request->has('s')) {
            $search = $request->get('s');
            $query->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
                  });
        }

        // فیلتر بر اساس تاریخ (اگر ارائه شده باشد)
        if ($request->has('date')) {
            $dateRange = explode(' to ', $request->get('date'));
            if (count($dateRange) == 2) {
                $startDate = date('Y-m-d', strtotime(trim($dateRange[0])));
                $endDate = date('Y-m-d', strtotime(trim($dateRange[1])));
                $query->whereBetween('due_date', [$startDate, $endDate]);
            }
        }

        // فیلتر بر اساس وضعیت پرداخت (اگر ارائه شده باشد)
        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->get('payment_status'));
        }

        // صفحه‌بندی نتایج
        $credits = $query->paginate(10);

        return view('credits', compact('credits'));
    }

    public function create()
    {
        // Get any necessary data for the create form (e.g., users, credit plans)
        $users = User::all();
        $creditPlans = CreditPlan::all();

        return view('credit', compact('users', 'creditPlans'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'amount' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id',
            'credit_plan_id' => 'nullable|integer|exists:credit_plans,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new Credit model instance
        $credit = new Credit;
        $credit->fill($request->all());
        $credit->save();

        // Flash a success message (optional)
        session()->flash('success', 'Credit created successfully!');

        return redirect()->route('credit.show');
    }

    public function edit($id)
    {
        // Find the credit by ID
        $credit = Credit::findOrFail($id);
        $this->authorizeAction($credit);
        // Get any necessary data for the edit form (e.g., users, credit plans)
        $users = User::all();
        $creditPlans = CreditPlan::all();
        $selectedOrder=[["id"=>$credit->order->id,"text"=>$credit->order->user->fullName." سفارش شماره ".$credit->order->id]];

        return view('credit', compact('credit', 'users', 'creditPlans','selectedOrder'));
    }

    public function update(Request $request, $id)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'amount' => 'required|numeric',
            'order' => 'required|integer',
            'due_date' => 'required|date',
            'updated_at' => 'nullable|date',
            'payment_method' => 'required|string',
            'ref_id' => 'nullable|string|max:255',
        ]);

        // Find the credit by ID
        $credit = Credit::findOrFail($id);
        $this->authorizeAction($credit);
        // به‌روزرسانی اطلاعات قسط
        $credit->update([
            'amount' => $request->input('amount'),
            'order_id' => $request->input('order'),
            'due_date' => Jalalian::fromFormat('Y-m-d', $request->input('due_date'))->toCarbon(),
        ]);
        if($request->input('ref_id')!=null)

            // به‌روزرسانی اطلاعات پرداخت مرتبط با قسط
            $credit->payment()->update([
                'updated_at' => Jalalian::fromFormat('Y-m-d', $request->input('updated_at'))->toCarbon(),
                'payment_method' => $request->input('payment_method'),
                'ref_id' => $request->input('ref_id'),
            ]);

        // بازگشت به صفحه لیست قسط‌ها با پیغام موفقیت
        return redirect()->route('credits.show')->with('success', 'قسط با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $credit = Credit::findOrFail($id);
        $credit->delete();

        session()->flash('success', 'Credit deleted successfully!');

        return back();
    }
}
