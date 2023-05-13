<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public function render($product_id)
    {
        $product = Product::find($product_id);
        $product->images = json_decode($product->images);
        return view('livewire.product-details', compact('product'));
    }
}
