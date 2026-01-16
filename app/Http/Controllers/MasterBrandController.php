<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand; 
use Illuminate\Validation\Rule;

class MasterBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('brands')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                })
            ],
            'category_id' => 'required|exists:categories,id',
        ]);
        Brand::create($validated);

        return redirect()->route('brand.manage')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {

        $categories = Category::all();
        return view('admin.brand.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {   



        $validated = $request->validate([
            'brand_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('brands')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                })
            ],
            'category_id' => 'required|exists:categories,id',
        ]);

        

        $brand->update($validated);

        return redirect()->route('brand.manage')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brand.manage')->with('success', 'Brand deleted successfully.');
    }
}
