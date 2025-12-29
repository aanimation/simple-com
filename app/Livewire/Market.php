<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Market extends Component
{
    public function addToCart($productId)
    {
        $product = Product::find($productId);
        $cart = Auth::user()->cart;

        if ($product->stock_quantity < 1) {
            return;
        }

        $cart->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => DB::raw('cart_items.quantity + 1')]
        );

        $this->dispatch('cartUpdated');

        /**
         * For test only
         */
        // \App\Jobs\DailySalesReportJob::dispatch();
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
