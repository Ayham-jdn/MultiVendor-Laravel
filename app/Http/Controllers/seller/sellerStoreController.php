<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Store;
use Illuminate\Support\Str;

class sellerStoreController extends Controller
{

    public function index()
    {
        $userid = Auth::user()->id;
        $stores = Store::where('user_id', Auth::id())->get();
        return view('seller.store.manage', compact('stores','userid'));
    }


    public function create()
    {
        return view('seller.store.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|min:3|max:100|unique:stores',
            'slug' => 'required|string|unique:stores',
            'details' => 'required|max:100',
        ]);

        Store::create([
            'store_name' => $request->store_name,
            'slug' => $request->slug,
            'details' => $request->details,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    public function edit(Store $store)
    {
        // Prevent editing other users' stores
        if ($store->user_id !== Auth::id()) {
            abort(403);
        }

        return view('seller.store.edit', compact('store'));
    }
    public function update(Request $request, Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'store_name' => 'required|string|min:3|max:100|unique:stores,store_name,' . $store->id,
            'slug' => 'required|string|unique:stores,slug,' . $store->id,
            'details' => 'required|string',
        ]);

        $store->update([
            'store_name' => $request->store_name,
            'slug' => $request->slug,
            'details' => $request->details,
        ]);

        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403);
        }

        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');
    }






}
