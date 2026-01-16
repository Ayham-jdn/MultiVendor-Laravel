<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;

class productAttributeController extends Controller
{
    public function index() {
        return view('admin.product_attribute.create');
    }
    public function manage() {
        $attributes = DefaultAttribute::latest()->paginate(10);
        return view('admin.product_attribute.manage', compact('attributes'));
    }
}
