<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function buyNow($id)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }

        $product = Products::findOrFail($id);

        // Create an order
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1, // Default quantity
            'total_price' => $product->price,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.success', ['order' => $order->id])->with('success', 'Order placed successfully!');
    }

    public function orderSuccess(Order $order)
    {
        return view('orders.success', compact('order'));
    }

    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('orders.index', ['orders'=>$orders]);
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
