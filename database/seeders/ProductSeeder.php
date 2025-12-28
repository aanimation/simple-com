<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Laptop',
                'price' => 4500.00,
                'stock_quantity' => 30,
            ],
            [
                'name' => 'Headphones',
                'price' => 299.00,
                'stock_quantity' => 15,
            ],
            [
                'name' => 'Keyboard',
                'price' => 199.00,
                'stock_quantity' => 24,
            ],
            [
                'name' => 'Microphone',
                'price' => 79.00,
                'stock_quantity' => 50,
            ],
            [
                'name' => 'Speaker',
                'price' => 100.00,
                'stock_quantity' => 8,
            ],
            [
                'name' => 'Monitor',
                'price' => 3300.00,
                'stock_quantity' => 20,
            ],
            [
                'name' => 'CPU Case',
                'price' => 40.00,
                'stock_quantity' => 18,
            ],
            [
                'name' => 'HDMI Cable',
                'price' => 5.00,
                'stock_quantity' => 50,
            ],
            [
                'name' => 'Foldable Table',
                'price' => 10.00,
                'stock_quantity' => 10,
            ],
            [
                'name' => 'Bag',
                'price' => 25.00,
                'stock_quantity' => 30,
            ],
        ]);
    }
}
