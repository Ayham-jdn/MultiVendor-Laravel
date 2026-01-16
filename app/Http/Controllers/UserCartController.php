<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;



class UserCartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $authUserRole = Auth::check() ? Auth::user()->role : null;
        return view('home.cart', compact('cartItems','authUserRole'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

public function update(Request $request, Cart $cart)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cart->quantity = $request->quantity;
    $cart->save();

    return redirect()->back();
}



    public function destroy(Cart $cart)
    {


        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'تم حذف المنتج من السلة');
    }
}

