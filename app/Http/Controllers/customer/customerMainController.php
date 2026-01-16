<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class customerMainController extends Controller
{
    public function index() {
        return view('customer.profile');
    }
    public function history() {
        return view('customer.history');
    }
    public function payment() {
        return view('customer.payment');
    }
    public function affiliate() {
        return view('customer.affiliate');
    }
    public function profile() {
        return view('customer.profile');
    }



}
