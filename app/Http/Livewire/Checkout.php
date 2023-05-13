<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class Checkout extends Component
{
    public function render()
    {
        if (Cart::count() <= 0) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('home');
        }
        return view('livewire.checkout');
    }
}
