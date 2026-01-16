<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sellerMainController extends Controller
{
    public function index() {
        return view('seller.dashboard');
    }
    public function orderhestory() {
        return view('seller.orderhistory');
    }
    public function account(){
        return view('seller.profile');
    }
}
