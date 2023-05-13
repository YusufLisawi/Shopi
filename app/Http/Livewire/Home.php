<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    private function getProducts($sort)
    {
        if ($sort === 'latest') {
            return Product::orderBy('created_at', 'DESC')->paginate(12)->appends(['sort' => $sort]);
        } elseif ($sort === 'low-to-high') {
            return Product::orderBy('price', 'ASC')->paginate(12)->appends(['sort' => $sort]);
        } elseif ($sort === 'high-to-low') {
            return Product::orderBy('price', 'DESC')->paginate(12)->appends(['sort' => $sort]);
        }

        return Product::paginate(12)->appends(['sort' => $sort]);
    }


    public function render(Request $request)
    {
        $sort = $request->input('sort');
        $products = $this->getProducts($sort);
        return view('livewire.home', [
            'products' => $products,
            'sort' => $sort
        ]);
    }
}
