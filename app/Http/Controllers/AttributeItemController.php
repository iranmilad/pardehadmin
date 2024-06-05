<?php

// app/Http/Controllers/AttributeItemController.php

namespace App\Http\Controllers;

use App\Models\AttributeItem;
use App\Models\Attribute;
use App\Models\Property;
use Illuminate\Http\Request;

class AttributeItemController extends Controller
{


    public function create($id)
    {
        $attribute = Attribute::find($id);
        return view('attribute', compact('attribute'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|string',
        ]);

        Property::create($validated);
        return redirect()->route('attributes.edit',$validated["attribute_id"])->with('success', 'Attribute Item created successfully.');
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $attribute = $property->attribute;
        return view('attribute', compact('property','attribute'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|string',
        ]);

        $Property = Property::findOrFail($id);
        $Property->update($validated);
        return redirect()->route('attributes.edit',$validated["attribute_id"])->with('success', 'Attribute Item updated successfully.');
    }

    public function delete(Request $request)
    {
        $property = Property::findOrFail($request->id);
        $property->delete();
        return redirect()->route('attributes.edit',$request->id)->with('success', 'Attribute Item deleted successfully.');
    }
}
