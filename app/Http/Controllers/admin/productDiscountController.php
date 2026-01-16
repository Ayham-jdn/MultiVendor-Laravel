<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productDiscountController extends Controller
{
    public function index() {
        return view('admin.discount.create');
    }
    public function manage() {
        return view('admin.discount.manage');
    }
}
