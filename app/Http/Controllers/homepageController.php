<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class homepageController extends Controller
{
    public function index() {
        $authUserRole = Auth::check() ? Auth::user()->role : null;
        $products = Product::with(['category', 'seller','images'])->where('visibility', true)->latest()->paginate(8);
        return view('home.index', compact('products','authUserRole'));
    }

    public function show($id){
        $authUserRole = Auth::check() ? Auth::user()->role : null;
        $product = Product::with('images')->findOrFail($id);
        $prev = Product::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $next = Product::where('id', '>', $id)->orderBy('id', 'asc')->first();
        return view('home.productdetails',compact('authUserRole',"product",'prev','next'));
    }
}
