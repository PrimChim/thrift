<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Carts::where('user_id', Auth::id())
            ->with('product')
            ->get();
            
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request, Products $product)
    {
        $existingCart = Carts::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + 1
            ]);
        } else {
            Carts::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Carts $cart)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function destroy(Carts $cart)
    {
        $cart->delete();
        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}