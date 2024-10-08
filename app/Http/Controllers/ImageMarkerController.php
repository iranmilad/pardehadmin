<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ImageMarker;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\View;

class ImageMarkerController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_image_markers';
    }

    public function index(Request $request)
    {
        // دریافت پارامتر جستجو
        $search = $request->input('s');

        // ساختن کوئری برای ImageMarker
        $query = ImageMarker::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // فیلتر کردن نتایج بر اساس جستجو
        if ($search) {
            $query->where('image_path', 'like', "%{$search}%");
        }

        // صفحه‌بندی نتایج
        $imageMarkers = $query->paginate(10);

        return view('image_markers.index', compact('imageMarkers'));
    }

    public function create()
    {
        return view('image_markers.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'image' => 'required',
            'marks' => 'required|json',
        ]);

        $imagePath = $request->input('image');

        ImageMarker::create([
            'image_path' => $imagePath,
            'marks' => $request->input('marks'),
        ]);

        return redirect()->route('image-markers.index')->with('success', 'Image marker created successfully.');
    }

    public function edit($id)
    {
        $imageMarker = ImageMarker::find($id);
        return view('image_markers.edit', compact('imageMarker'));
    }

    public function update(Request $request,$id)
    {
        //dd($request);
        $request->validate([
            'image' => 'required',
            'marks' => 'required|json',
        ]);

        if ($request->input('image')) {
            $imagePath = $request->input('image');
            $imageMarker = ImageMarker::find($id);
            $imageMarker->update(['image_path' => $imagePath]);
        }

        $imageMarker->update(['marks' => $request->input('marks')]);

        return redirect()->route('image-markers.index')->with('success', 'Image marker updated successfully.');
    }

    public function destroy($id)
    {
        $imageMarker = ImageMarker::find($id);
        $imageMarker->delete();

        return redirect()->route('image-markers.index')->with('success', 'Image marker deleted successfully.');
    }


    public function checkProduct($id)
    {
        $imageMarker = ImageMarker::find($id);

        if (!$imageMarker) {
            return response()->json([], 404);
        }

        $products = json_decode($imageMarker->marks, true);
        $response = [];

        foreach ($products as $product) {
            $response[] = [
                "dataId" => $product['dataId'],
                "productName" => $product['productName'],
                "top" => $product['top'],
                "left" => $product['left']
            ];
        }

        return response()->json($response);
    }


    public function imgdot($id){
        $product= Product::find($id);

        $product = [
            "name" => $product->title,
            "img" => $product->img,
            "price" => number_format($product->price),
            "discounted_price" => number_format($product->sale_price),
            "discount" => $product->discountPercentage
        ];

        $html = View::make("components/imgdot", $product)->render();

        return response()->json(['html' => $html]);
    }

}
