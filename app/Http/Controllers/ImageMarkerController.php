<?php

namespace App\Http\Controllers;

use App\Models\ImageMarker;
use Illuminate\Http\Request;

class ImageMarkerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('s');
        $query = ImageMarker::query();

        if ($search) {
            $query->where('image_path', 'like', "%{$search}%");
        }

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

    public function edit(ImageMarker $imageMarker)
    {
        return view('image_markers.edit', compact('imageMarker'));
    }

    public function update(Request $request, ImageMarker $imageMarker)
    {
        //dd($request);
        $request->validate([
            'image' => 'nullable|image',
            'marks' => 'required|json',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $imageMarker->update(['image_path' => $imagePath]);
        }

        $imageMarker->update(['marks' => $request->input('marks')]);

        return redirect()->route('image-markers.index')->with('success', 'Image marker updated successfully.');
    }

    public function destroy(ImageMarker $imageMarker)
    {
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

}
