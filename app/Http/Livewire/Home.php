<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    public $pageSize = 10;

    public function resizePage($value)
    {
        $this->pageSize = $value;
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::paginate($this->pageSize);
        return view('livewire.home', ['products' => $products, 'pageSize' => $this->pageSize]);
    }
}
