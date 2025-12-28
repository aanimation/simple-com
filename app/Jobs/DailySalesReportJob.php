<?php

namespace App\Jobs;

use App\Models\OrderItem;
use App\Mail\DailySalesReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DailySalesReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $sales = OrderItem::query()
            ->whereDate('created_at', today())
            ->with('product')
            ->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'product' => $items->first()->product->name,
                    'quantity' => $items->sum('quantity'),
                    'revenue' => $items->sum(fn ($i) => $i->quantity * $i->price),
                ];
            });

        Mail::to('admin@example.com')
            ->send(new DailySalesReportMail($sales));
    }
}
