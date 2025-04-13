<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class SupplierController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        $this->permissionName = 'manage_suppliers';
    }

    public function index(Request $request)
    {
        $query = Supplier::orderBy('created_at', 'desc');

        $query = $this->applyAccessControl($query);

        $search = $request->input('s');
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('delivery_areas', 'like', "%{$search}%");
        }

        $suppliers = $query->paginate(10);

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $delivery_areas = $this->getProvinces();
        return view('suppliers.create', compact('delivery_areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'payment_type' => 'required|string|in:online,cash,credit',
            'delivery_areas' => 'nullable|array|max:500',
            'buy_type' => 'required|string|in:direct,agent',
        ]);

        $validated['delivery_areas'] = $validated['delivery_areas'] ?? [];
        $validated['delivery_areas'] = json_encode($validated['delivery_areas']);
        
        Supplier::create($validated);

        return redirect()->route('suppliers.index')->with('success', 'تأمین‌کننده با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.create', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'payment_type' => 'required|string|in:online,cash,credit',
            'delivery_areas' => 'nullable|string|max:500',
            'buy_type' => 'required|string|in:direct,agent',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validated);

        return redirect()->route('suppliers.edit', $id)->with('success', 'تأمین‌کننده با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'checked_row' => 'required|array',
            'checked_row.*' => 'integer|exists:suppliers,id',
        ]);

        if ($request->input('action') == 'delete') {
            $supplierIds = $request->input('checked_row');
            Supplier::whereIn('id', $supplierIds)->delete();

            return redirect()->route('suppliers.index')->with('success', 'تأمین‌کنندگان با موفقیت حذف شدند.');
        }

        return redirect()->route('suppliers.index')->with('error', 'عملیات معتبر نمی‌باشد.');
    }

    private function getProvinces()
    {
        $json = File::get(public_path('/js/iran_cities_with_coordinates.json'));
        $data = json_decode($json, true);

        $provinces = [];
        foreach ($data as $province) {
            $provinces[] = $province['name'];
        }

        return $provinces;
    }

}
