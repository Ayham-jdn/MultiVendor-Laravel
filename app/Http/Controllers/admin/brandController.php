<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand; 

class brandController extends Controller
{
    public function index() {
        return view('admin.brand.create');
    }
    public function manage() {
        $brands = Brand::all();
        return view('admin.brand.manage', compact('brands'));
    }
}
