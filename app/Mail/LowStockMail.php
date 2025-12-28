<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowStockMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Product $product)
    {
        // code
    }

    public function build()
    {
        return $this->subject('Admin Low Stock Alert')
            ->view('emails.low-stock');
    }
}
