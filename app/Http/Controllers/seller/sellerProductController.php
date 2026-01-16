<?php

namespace App\Http\Controllers\seller;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;


class sellerProductController extends Controller
{
    public function index() {
        $authsellerid = Auth::id();
        $products = Product::where('seller_id', $authsellerid)->get();
        return view('seller.product.manage', compact('products'));
    }
 
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all(); 
        $authuserid = Auth::id();
        $stores = Store::where('user_id', $authuserid)->get();
        return view('seller.product.create', compact('stores', 'brands','categories'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'product_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'sku' => 'required|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'stock_status' => 'required|in:In Stock,Out of Stock',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'slug' => 'required|string|unique:products',
            'visibility' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:Draft,Published',
        ]);


        $product = Product::create([
            ...$request->except('images', 'seller_id'),
            'seller_id' => Auth::id(),
        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {
                $filename = $product->slug . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_images'), $filename);
                $path = 'product_images/' . $filename;
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                    'its_primary' => false,
                ]);
            }
        }
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $pro = product::findOrFail($product->id);
        $products = product::with('brand', 'category' ,'images')->findOrFail($product->id);
        $categories = Category::all();
        $brands = Brand::select('id', 'brand_name', 'category_id')->get();
        $stores = Store::where('user_id', Auth::id())->get();
        return view('seller.product.edit', compact('products', 'categories', 'brands', 'stores','pro'));
    }

    public function update(Request $request, Product $product)
    {

        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'tax_rate' => 'numeric',
            'stock_quantity' => 'integer',
            'stock_status' => 'required|in:In Stock,Out of Stock',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'visibility' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:Draft,Published',
        ]);



        $product->update($request->except('seller_id'));

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted.');
    }



}
