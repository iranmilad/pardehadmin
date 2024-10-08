<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportRegion;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TransportController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_transports';
    }

    public function index(Request $request)
    {
        $search = $request->get('s', '');
        $query = TransportRegion::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // جستجو بر اساس عنوان و مناطق
        $query->when($search, function ($query, $search) {
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('regions', 'LIKE', "%{$search}%");
        });

        $transports = $query->paginate(10);

        return view('transports', compact('transports'));
    }

    public function create()
    {
        $provinces = $this->getProvinces();
        return view('transport', compact('provinces'));
    }

    public function edit($id)
    {
        $transport = TransportRegion::findOrFail($id);
        $this->authorizeAction($transport);
        $provinces = $this->getProvinces();
        return view('transport', compact('transport', 'provinces'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'regions' => 'nullable|array',
            'cost' => 'required|string|in:free,local,fixed_rate,value_based,weight_based,volume_based',
            'price' => 'nullable|numeric',
            'percentage_of_cart_value' => 'nullable|numeric',
            'weight_based_cost' => 'nullable|numeric',
            'dimension_based_cost' => 'nullable|numeric',
        ]);

        $data['cost_type'] = $data['cost'];
        unset($data['cost']);

        // اگر regions ثبت نشده بود، آرایه‌ی خالی ذخیره شود
        $data['regions'] = $data['regions'] ?? [];

        // Check if user has the role 'Transporter'
        if (Auth::user()->hasRole('Transporter')) {
            $data['user_id'] = Auth::id();
        }

        TransportRegion::create($data);

        return redirect()->route('transports.index')->with('success', 'منطقه حمل و نقل با موفقیت ایجاد شد.');
    }

    public function update(Request $request, $id)
    {
        $transport = TransportRegion::findOrFail($id);
        $this->authorizeAction($transport);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'regions' => 'nullable|array',
            'cost' => 'required|string|in:free,local,fixed_rate,value_based,weight_based,volume_based',
            'price' => 'nullable|numeric',
            'percentage_of_cart_value' => 'nullable|numeric',
            'weight_based_cost' => 'nullable|numeric',
            'dimension_based_cost' => 'nullable|numeric',
        ]);

        $data['cost_type'] = $data['cost'];
        unset($data['cost']);

        // اگر regions ثبت نشده بود، آرایه‌ی خالی ذخیره شود
        $data['regions'] = $data['regions'] ?? [];
        
            // Check if user has the role 'Transporter'
        if (Auth::user()->hasRole('Transporter')) {
            $data['user_id'] = Auth::id();
        } else {
            $data['user_id'] = null;
        }

        $transport->update($data);

        return redirect()->route('transports.index')->with('success', 'منطقه حمل و نقل با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $transport = TransportRegion::findOrFail($request->id);
        $this->authorizeAction($transport);
        $transport->delete();

        return redirect()->route('transports.index')->with('success', 'منطقه حمل و نقل با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        // Bulk action logic here
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
