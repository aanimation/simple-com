<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class HomeProductList extends Component
{
    use WithPagination;

    protected int $pageCount = 4;

    protected function getData()
    {
        $lowestStock = config('stock.lowest_stock');

        $products = Product::query()
                ->where('stock_quantity', '>=', $lowestStock)
                ->paginate($this->pageCount);

        return [
            'products' => $products,
        ];
    }
    
    public function render()
    {
        return view('livewire.home-product-list', $this->getData());
    }
}
