<div class="p-4 border rounded">
    <h2 class="text-xl font-bold mb-4">Your Cart</h2>

    @forelse ($cart->items as $item)
        <div class="flex justify-between items-center mb-2">
            <div>
                <p class="font-semibold">{{ $item->product->name }}</p>
                <p class="text-sm text-gray-500">
                    RM {{ number_format($item->product->price, 2) }}
                </p>
            </div>

            <div class="flex items-center gap-2">
                <button wire:click="decrement({{ $item->id }})"
                        class="px-2 bg-gray-200 rounded">−</button>

                <span>{{ $item->quantity }}</span>

                <button wire:click="increment({{ $item->id }})"
                        class="px-2 bg-gray-200 rounded">+</button>

                <button wire:click="remove({{ $item->id }})"
                        class="ml-2 text-red-600">Remove</button>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Your cart is empty.</p>
    @endforelse

    <div class="mt-4 font-bold">
        Total: RM {{ number_format($total, 2) }}
    </div>
</div>
