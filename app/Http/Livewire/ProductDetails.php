<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public function render($product_id)
    {
        $product = Product::find($product_id);
        if (json_decode($product->images) != null) {
            $product->images = json_decode($product->images);
        }
        else {
            $product->images = [$product->image, $product->images];
        }
        return view('livewire.product-details', compact('product'));
    }
}
