<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart as CartFacade;
use Illuminate\Http\Request;

class Cart extends Component
{
    public function addToCart(Request $request)
    {
        $p = Product::find($request->input('product_id'));
        CartFacade::add($p->id, $p->name, 1, $p->price)->associate('App\Models\Product');
        session()->flash('success', 'Item added in Cart');
        return redirect()->route('cart');
    }
    public function incQty(Request $req)
    {
        $rowId = $req->row_id;
        $product = CartFacade::get($rowId);
        $qty = $product->qty + 1;
        CartFacade::update($rowId, $qty);
        return redirect()->route('cart');
    }
    public function decQty(Request $req)
    {
        $rowId = $req->row_id;
        $product = CartFacade::get($rowId);
        $qty = $product->qty - 1;
        CartFacade::update($rowId, $qty);
        return redirect()->route('cart');
    }
    public function destroyItem(Request $req)
    {
        $rowId = $req->row_id;
        CartFacade::remove($rowId);
        session()->flash('success', 'Item has been removed from cart');
        return redirect()->back();
    }
    public function destroyCart(Request $req)
    {
        CartFacade::destroy();
        session()->flash('success', 'Cart has been cleared');
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
