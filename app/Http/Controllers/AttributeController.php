<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::orderBy('created_at', 'desc')->paginate(10);
        return view('attributes', compact('attributes'));
    }

    public function create()
    {
        return view('attributeCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'countable' => 'required|boolean',
            'unit' => 'nullable|string|max:50',
            'display_type' => 'required|string|max:50',
            'img' => 'nullable|string|max:255',
            'guide_link' => 'nullable|string|max:255',
        ]);

        Attribute::create($validated);
        return redirect()->route('attributes.list')->with('success', 'ویژگی با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('attributeCreate', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'countable' => 'required|boolean',
            'unit' => 'nullable|string|max:50',
            'display_type' => 'required|string|max:50',
            'img' => 'nullable|string|max:255',
            'guide_link' => 'nullable|string|max:255',
        ]);

        $attribute = Attribute::findOrFail($id);
        $attribute->update($validated);
        return redirect()->route('attributes.edit',$id)->with('success', 'ویژگی با موفقیت به روز رسانی شد.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'checked_row' => 'required|array',
            'checked_row.*' => 'integer|exists:attributes,id',
        ]);

        if ($request->input('action') == 'delete') {
            $attributeIds = $request->input('checked_row');
            Attribute::whereIn('id', $attributeIds)->delete();

            return redirect()->route('attributes.list')->with('success', 'ویژگی‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('attributes.list')->with('error', 'عملیات معتبر نمی‌باشد.');
    }


    public function getOptions($attributeId)
    {
        $attribute = Attribute::with('items')->findOrFail($attributeId);

        $options = $attribute->items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
            ];
        });

        return response()->json($options);
    }
}
