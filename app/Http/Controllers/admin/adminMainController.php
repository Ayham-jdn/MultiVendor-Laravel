<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminMainController extends Controller
{
    public function index(){
        return view('admin.admin');
    }
    public function setting(){
        return view('admin.setting');
    }
    public function account(){
        return view('admin.profile');
    }
    public function manageUser(){
        return view('admin.manage.user');
    }
    public function manageStores(){
        return view('admin.manage.store');
    }
    public function cartHistory(){
        return view('admin.cart.history');
    }
    public function orderHistory(){
        return view('admin.order.history');
    }
    public function sellerAcc(){
        return view('admin.sellers.accounts');
    }
}
