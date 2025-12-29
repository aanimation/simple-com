<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public function increment(CartItem $item)
    {
        $item->increment('quantity');
    }

    public function decrement(CartItem $item)
    {
        if ($item->quantity <= 1) {
            $this->remove($item);
            return;
        }

        $item->decrement('quantity');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
    }

    public function makeOrder($total)
    {
        Order::updateOrCreate([
            'user_id' => Auth::id(),
        ],[
            'total_price' => $total
        ]);
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