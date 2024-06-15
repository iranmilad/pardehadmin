<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Check;
use App\Models\Order;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CheckController extends Controller
{
    /**
     * Display a listing of the checks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('s')) {
            $search = $request->get('s');
            $query->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }
        // افزودن شرط برای paymentMethod برابر با check

        $query->where('paymentMethod', 'check');

        $orders = $query->paginate(10);

        return view('checks', compact('orders'));
    }

    /**
     * Show the form for creating a new check.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        return view('check', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'checks' => 'required|array',
            'checks.*.check_number' => 'required|string|max:255',
            'checks.*.amount' => 'required|numeric',
            'checks.*.due_date' => 'required|date',
            'checks.*.payment_status' => 'required|string|in:paid,unpaid',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Create Check records from the incoming data
        foreach ($request->checks as $checkData) {
            Check::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'check_number' => $checkData['check_number'],
                'amount' => $checkData['amount'],
                'due_date' => Jalalian::fromFormat('Y-m-d', $checkData['due_date'])->toCarbon(),
                'payment_status' => $checkData['payment_status'],
            ]);
        }

        // Redirect or return a response as needed
        return redirect()->route('checks.list')->with('success', 'چک‌ها با موفقیت ثبت شدند.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('check', compact('order'));
    }

    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);

        $request->validate([
            'checks' => 'required|array',
            'checks.*.check_number' => 'required|string|max:255',
            'checks.*.amount' => 'required|numeric',
            'checks.*.due_date' => 'required|date',
            'checks.*.payment_status' => 'required|string|in:paid,unpaid',
        ]);

        // Delete all existing checks for the order
        $order->checks()->delete();

        // Create new checks
        foreach ($request->checks as $checkData) {
            Check::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'check_number' => $checkData['check_number'],
                'amount' => $checkData['amount'],
                'due_date' => $checkData['due_date'],
                'payment_status' => $checkData['payment_status'],
            ]);
        }

        return redirect()->route('checks.list')->with('success', 'چک‌ها با موفقیت ویرایش شدند.');
    }

    /**
     * Remove the specified check from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $check = Check::findOrFail($request->id);
        $check->delete();

        return redirect()->route('checks.list')->with('success', 'چک با موفقیت حذف شد.');
    }

    /**
     * Perform bulk actions on selected checks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulk_action(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('checked_rows');

        if ($action == 'delete' && !empty($ids)) {
            Check::destroy($ids);
            return redirect()->route('checks.list')->with('success', 'چک‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('checks.list')->with('error', 'عملیات نامعتبر است.');
    }
}
