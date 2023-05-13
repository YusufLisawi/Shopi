<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{

    public function makeOrder(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'billing_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required|numeric',
        ]);

        $order = new Order([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'total' => Cart::total(),
            'country' => $request->input('country'),
            'billing_address' => $request->input('billing_address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zipcode' => $request->input('zipcode'),
            'order_notes' => $request->input('order_notes')
        ]);
        $order->save();
        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'price' => $item->price
            ]);
            $orderItem->save();
        }
        Cart::destroy();
        return redirect()->route('home')->with('success', 'Your order has been placed successfully.');
    }

    public function render()
    {
        if (Cart::count() <= 0) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('home');
        }
        return view('livewire.checkout');
    }
}
