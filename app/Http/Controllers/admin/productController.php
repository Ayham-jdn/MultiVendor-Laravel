<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index() {
        return view('admin.product.manage');
    }
    public function reviewManage() {
        return view('admin.product.manage_review');
    }
}
