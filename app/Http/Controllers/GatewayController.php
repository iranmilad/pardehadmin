<?php

namespace App\Http\Controllers;

use App\Models\Gateway;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class GatewayController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_gateways';
    }

    public function index(Request $request)
    {
        // دریافت پارامترهای جستجو و صفحه‌بندی
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // تعداد نتایج در هر صفحه

        // ساختن کوئری برای Gateway
        $query = Gateway::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // فیلتر کردن نتایج بر اساس جستجو
        $query->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        });

        // صفحه‌بندی نتایج
        $gateways = $query->paginate($perPage);

        return view('gateways', compact('gateways', 'search', 'perPage'));
    }

    public function create()
    {
        return view('gateway-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'merchant_code' => 'nullable|string',
            'success_message' => 'nullable|string',
            'failure_message' => 'nullable|string',
        ]);

        $gateway = new Gateway();
        $gateway->title = $request->title;
        $gateway->type = $request->type;

        if ($request->type === 'online') {
            $gateway->merchant_code = $request->merchant_code;
            $gateway->success_message = $request->success_message;
            $gateway->failure_message = $request->failure_message;
            if ($request->hasFile('logo')) {
                $gateway->logo = $request->file('logo')->store('logos', 'public');
            }
        }

        $gateway->save();

        if ($request->type === 'cardbycard') {
            foreach ($request->bank_accounts as $account) {
                $gateway->bankAccounts()->create([
                    'bankname' => $account['bankname'],
                    'accountnumber' => $account['accountnumber'],
                    'cardnumber' => $account['cardnumber'],
                ]);
            }
        }

        return redirect()->route('gateways.index')->with('success', 'روش پرداخت با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $gateway = Gateway::findOrFail($id);
        return view('gateway', compact('gateway'));
    }

    public function update(Request $request, $id)
    {
        $gateway = Gateway::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'merchant_code' => 'nullable|string',
            'success_message' => 'nullable|string',
            'failure_message' => 'nullable|string',
            'logo' => 'nullable|image',
        ]);

        $gateway->title = $request->title;
        if ($gateway->type === 'online') {
            $gateway->merchant_code = $request->merchant_code;
            $gateway->success_message = $request->success_message;
            $gateway->failure_message = $request->failure_message;
            if ($request->hasFile('logo')) {
                $gateway->logo = $request->file('logo')->store('logos', 'public');
            }
        }

        $gateway->save();

        if ($gateway->type === 'cardbycard') {
            $gateway->bankAccounts()->delete();
            foreach ($request->bank_accounts as $account) {
                $gateway->bankAccounts()->create([
                    'bankname' => $account['bankname'],
                    'accountnumber' => $account['accountnumber'],
                    'cardnumber' => $account['cardnumber'],
                ]);
            }
        }

        return redirect()->route('gateways.index')->with('success', 'روش پرداخت با موفقیت ویرایش شد.');
    }

    public function destroy($id)
    {
        $gateway = Gateway::findOrFail($id);
        $gateway->delete();
        return redirect()->route('gateways.index')->with('success', 'روش پرداخت با موفقیت حذف شد.');
    }

    public function activate($id, Request $request)
    {
        $gateway = Gateway::findOrFail($id);
        $is_active = $request->input('is_active');

        $gateway->is_active = $is_active;
        $gateway->save();

        return redirect()->route('gateways.index')->with('success', 'وضعیت روش پرداخت با موفقیت تغییر یافت.');
    }

    public function bulk_action(Request $request)
    {
        // عملیات گروهی (فعال کردن، غیر فعال کردن، حذف)
    }
}
