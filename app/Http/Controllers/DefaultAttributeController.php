<?php

namespace App\Http\Controllers;

use App\Models\DefaultAttribute;
use Illuminate\Http\Request;

class DefaultAttributeController extends Controller
{
    public function index()
    {
        $attributes = DefaultAttribute::latest()->paginate(10);

    }

    public function create()
    {
        return view('admin.product_attribute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_value' => 'required|string|max:50|unique:default_attributes',
        ]);

        DefaultAttribute::create([
            'attribute_value' => $request->attribute_value,
        ]);

        return redirect()->route('productattribute.manage')->with('success', 'Attribute created successfully.');
    }

    public function edit(DefaultAttribute $productattribute)
    {
        return view('admin.product_attribute.edit', compact('productattribute'));
    }

    public function update(Request $request, DefaultAttribute $productattribute)
    {
        $request->validate([
            'attribute_value' => 'required|string|max:50|unique:default_attributes,attribute_value,' . $productattribute->id,
        ]);

        $productattribute->update([
            'attribute_value' => $request->attribute_value,
        ]);

        return redirect()->route('productattribute.manage')->with('success', 'Attribute updated successfully.');
    }

    public function destroy(DefaultAttribute $productattribute)
    {
        $productattribute->delete();
        return redirect()->route('productattribute.manage')->with('success', 'Attribute deleted successfully.');
    }
}

