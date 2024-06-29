<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportRegion;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class TransportController extends Controller
{
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

    public function index(Request $request)
    {
        $search = $request->get('s', '');
        $transports = TransportRegion::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('regions', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

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
        $provinces = $this->getProvinces();
        return view('transport', compact('transport', 'provinces'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'regions' => 'required|array',
            'cost' => 'required|string|in:free,local,fixed,percentage,weight,dimension',
            'price' => 'nullable|numeric',
            'percentage_of_cart_value' => 'nullable|numeric',
            'weight_based_cost' => 'nullable|numeric',
            'dimension_based_cost' => 'nullable|numeric',
        ]);

        $data['cost_type'] = $data['cost'];
        unset($data['cost']);

        // Check if user has the role 'Transporter'
        if (Auth::user()->hasRole('Transporter')) {
            $data['user_id'] = Auth::id();
        }

        TransportRegion::create($data);

        return redirect()->route('transports.list')->with('success', 'منطقه حمل و نقل با موفقیت ایجاد شد.');
    }

    public function update(Request $request, $id)
    {
        $transport = TransportRegion::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'regions' => 'required|array',
            'cost' => 'required|string|in:free,local,fixed,percentage,weight,dimension',
            'price' => 'nullable|numeric',
            'percentage_of_cart_value' => 'nullable|numeric',
            'weight_based_cost' => 'nullable|numeric',
            'dimension_based_cost' => 'nullable|numeric',
        ]);

        $data['cost_type'] = $data['cost'];
        unset($data['cost']);

        // Check if user has the role 'Transporter'
        if (Auth::user()->hasRole('Transporter')) {
            $data['user_id'] = Auth::id();
        } else {
            $data['user_id'] = null;
        }

        $transport->update($data);

        return redirect()->route('transports.list')->with('success', 'منطقه حمل و نقل با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $transport = TransportRegion::findOrFail($request->id);
        $transport->delete();

        return redirect()->route('transports.list')->with('success', 'منطقه حمل و نقل با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        // Bulk action logic here
    }
}
