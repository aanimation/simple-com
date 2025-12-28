<div class="grid grid-cols-3 gap-4">
    @foreach ($products as $product)
        <div class="p-4 border rounded">
            <h3 class="font-bold">{{ $product->name }}</h3>
            <p>RM {{ number_format($product->price, 2) }}</p>
            <p class="text-sm text-gray-500">
                Stock: {{ $product->stock_quantity }}
            </p>

            <button
                wire:click="addToCart({{ $product->id }})"
                class="mt-2 px-4 py-2 bg-blue-600 text-white rounded"
                @disabled($product->stock_quantity < 1)
            >
                Add to Cart
            </button>
        </div>
    @endforeach
</div>
