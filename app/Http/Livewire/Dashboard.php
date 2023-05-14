<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function invoice(Order $order)
    {
        return view('livewire.invoice', compact('order'));
    }

    public function render()
    {
        $user = Auth::user();

        $orders = Order::with('orderItems')
            ->where('user_id', $user->id)
            ->get();

        return view('livewire.dashboard', compact('orders'));
    }
}
