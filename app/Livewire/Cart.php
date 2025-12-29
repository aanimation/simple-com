<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public function increment(CartItem $item)
    {
        $item->increment('quantity');
        // $item->load('product');
        // $item->product->decrement('stock_quantity');
    }

    public function decrement(CartItem $item)
    {
        if ($item->quantity <= 1) {
            $this->remove($item);
            return;
        }

        $item->decrement('quantity');
        // $item->load('product');
        // $item->product->increment('stock_quantity');
    }

    public function remove(CartItem $item)
    {
        // $item->load('product');
        // $item->product->increment('stock_quantity', $item->quantity);
        $item->delete();
    }

    protected function getData()
    {
        $cart = Auth::user()->cart()->with('items.product')->first();

        return [
            'cart' => $cart,
            'total' => $cart->items->sum(fn ($item) =>
                $item->quantity * $item->product->price
            ),
        ];
    }

    public function render()
    {
        return view('livewire.cart', $this->getData());
    }
}