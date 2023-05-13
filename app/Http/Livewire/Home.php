<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    private function getProducts($sort, $selectedCategory, $search, $priceFilter)
    {
        $query = Product::query();

        if ($selectedCategory) {
            $query->whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories.slug', $selectedCategory);
            });
        }

        if ($priceFilter) {
            preg_match('/\$(\d+)\s+-\s+\$(\d+)/', $priceFilter, $matches);

            if (count($matches) == 3) {
                $minPrice = $matches[1];
                $maxPrice = $matches[2];
            }
        }

        if (isset($minPrice) && isset($maxPrice)) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhereHas('categories', function ($query) use ($search) {
                          $query->where('categories.name', 'like', '%' . $search . '%');
                      });
            });
        }

        if ($sort === 'latest') {
            $query->orderBy('created_at', 'DESC');
        } elseif ($sort === 'low-to-high') {
            $query->orderBy('price', 'ASC');
        } elseif ($sort === 'high-to-low') {
            $query->orderBy('price', 'DESC');
        }

        // Fetch the paginated products and append the sort and category parameters
        return $query->paginate(12)->appends(['sort' => $sort, 'category' => $selectedCategory, 'range' => $priceFilter, 'search' => $search]);
    }


    public function render(Request $request)
    {
        $sort = $request->input('sort');
        $selectedCategory = $request->input('category');
        $search = $request->input('search');
        $priceFilter = $request->input('range');
        $products = $this->getProducts($sort, $selectedCategory, $search, $priceFilter);
        $categories = Category::all();
        return view('livewire.home', [
            'products' => $products,
            'sort' => $sort,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories
        ]);
    }
}
