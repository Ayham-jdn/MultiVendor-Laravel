<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class MasterCategoryController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('admin.category.create');
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'unique:categories|max:100',
        ]);
    
        Category::create($validateData);
    
        return redirect()->route('category.manage')->with('success', 'Category created.');
    }
    
    public function edit(Category $category)
    {

        return view('admin.category.edit', compact('category'));
    }
    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryName' => 'unique:categories|string|max:100',
        ]);
    
        $category->update($request->all());
    
        return redirect()->route('category.manage')->with('success', 'Category updated.');
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.manage')->with('warning', 'Category deleted.');
    }
    
}
