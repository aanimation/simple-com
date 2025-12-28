<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Market extends Component
{
    public function addToCart(Product $product)
    {
        $cart = Auth::user()->cart;

        if ($product->stock_quantity < 1) {
            return;
        }

        $cart->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => DB::raw('quantity + 1')]
        );

        $product->decrement('stock_quantity');
    }

    protected function getData()
    {
        return [
            'products' => Product::all(),
        ];
    }

    public function render()
    {
        return view('livewire.market', $this->getData());
    }
}
