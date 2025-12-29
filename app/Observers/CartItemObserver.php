<?php

namespace App\Observers;

use App\Models\CartItem;
use App\Jobs\LowStockNotificationJob;
use Illuminate\Support\Facades\DB;

class CartItemObserver
{
    public function created(CartItem $cartItem): void
    {
        $this->handleStockChange($cartItem, CartItem::find($cartItem->id)->quantity);
    }

    public function updated(CartItem $cartItem): void
    {
        $diff = CartItem::find($cartItem->id)->quantity - $cartItem->getOriginal('quantity');

        if ($diff !== 0) {
            $this->handleStockChange($cartItem, $diff);
        }
    }

    public function deleted(CartItem $cartItem): void
    {
        $product = $cartItem->product;
        $product->increment('stock_quantity', $cartItem->quantity);
    }

    protected function handleStockChange(CartItem $cartItem, int $quantityDiff): void
    {
        $product = $cartItem->product;

        if ($product->stock_quantity - $quantityDiff < 0) {
            return;
        }

        DB::transaction(function () use ($product, $quantityDiff) {
            $product->decrement('stock_quantity', $quantityDiff);

            if ($product->stock_quantity <= config('stock.lowest_stock')) {
                LowStockNotificationJob::dispatch($product);
            }
        });
    }
}
