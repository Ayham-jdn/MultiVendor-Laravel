<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheackoutController extends Controller
{
     function index() {
        $authUserRole = Auth::check() ? Auth::user()->role : null;
        return view('home.cheackout',compact('authUserRole'));
    }
}
