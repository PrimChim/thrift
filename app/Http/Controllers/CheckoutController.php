<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Carts::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn ($item) => $item->product->price * $item->quantity);

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = Carts::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            foreach ($cartItems as $item) {
                Order::create([
                    'user_id' => $user->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'total_price' => $item->quantity * $item->product->price,
                    'status' => 'pending', // Default status
                ]);
            }

            // Clear the cart after checkout
            Carts::where('user_id', $user->id)->delete();

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
