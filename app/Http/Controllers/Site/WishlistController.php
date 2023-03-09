<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $products = auth()->user()->wishlist()->latest()->get();
        return view('front.wishlists', compact('products'));
    }
    public function store()
    {
        if (!auth()->user()->wishlistHasThisProduct(request('product_id'))) {
            auth()->user()->wishlist()->attach(request('product_id'));
            return response()->json(['status' => true, 'wished' => true]);
        }
        return response()->json(['status' => true, 'wished' => false]);  //  added before to favourite list
    }

    public function destroy()
    {
        auth()->user()->wishlist()->detach(request('product_id'));
    }
}
