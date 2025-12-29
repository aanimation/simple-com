<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $this->fillOrderItems($order);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $this->fillOrderItems($order);
    }

    protected function fillOrderItems($order)
    {
        // Eager load relations
        $order->load([
            'user',
            'user.cart.items.product',
        ]);

        DB::transaction(function () use ($order) {
            $cart = $order->user->cart;

            if (! $cart || $cart->items->isEmpty()) {
                return;
            }

            $orderItems = $cart->items->map(fn ($item) => [
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price
            ]);

            $order->items()->insert($orderItems->toArray());

            // Clean current user cart without model event
            $cart->items()->getQuery()->delete();
        });
    }

}
