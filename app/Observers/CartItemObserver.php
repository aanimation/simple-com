<?php

namespace App\Observers;

use App\Models\CartItem;
use App\Jobs\LowStockNotificationJob;
use Exception;
use Illuminate\Support\Facades\DB;

class CartItemObserver
{
    public function created(CartItem $cartItem): void
    {
        $this->handleStockChange($cartItem, $cartItem->quantity);
    }

    public function updated(CartItem $cartItem): void
    {
        $diff = $cartItem->quantity - $cartItem->getOriginal('quantity');

        if ($diff !== 0) {
            $this->handleStockChange($cartItem, $diff);
        }
    }

    protected function handleStockChange(CartItem $cartItem, int $quantityDiff): void
    {
        $product = $cartItem->product;

        // if ($product->stock_quantity < $quantityDiff) {
        //     throw new Exception('Insufficient stock');
        // }

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
