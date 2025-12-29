<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-semibold text-gray-400 mb-8">Shopping Cart</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-8">
            @forelse ($cart->items as $item)
                <div class="flex gap-6 border-b pb-8">
                    <img src="/products/{{ Str::lower(Str::kebab($item->product->name)) }}.jpg"
                        alt="product-image"
                        class="h-32 w-32 rounded-lg object-cover"
                    />

                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-gray-300">
                                    {{ $item->product->name }}
                                </h3>
                                <p class="mt-2 text-sm font-medium text-gray-300">
                                    ${{ $item->product->price }}
                                </p>
                            </div>

                            <button wire:click="remove({{ $item->id }})"
                                class="text-gray-400 hover:text-gray-600 cursor-pointer">&cross;</button>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center border rounded-md w-max">
                                <button wire:click="decrement({{ $item->id }})" type="button" class="px-3 py-1 text-gray-600 hover:bg-gray-200 cursor-pointer">
                                    &minus;
                                </button>

                                <input type="number" value="{{ $item->quantity }}" readonly
                                    class="w-20 text-center text-sm border-x"
                                />

                                <button wire:click="increment({{ $item->id }})" type="button" class="px-3 py-1 text-gray-600 hover:bg-gray-200 cursor-pointer">
                                    &plus;
                                </button>
                            </div>

                            @if($item->quantity <= $item->product->stock_quantity)
                                <div class="flex items-center gap-2 text-sm text-blue-300">
                                    <span>&check;</span>
                                    <span>In stock</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-sm text-red-300">
                                    <span>&cross;</span>
                                    <span>Out stock</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Your cart is empty.</p>
            @endforelse
        </div>

        <!-- Order summary -->
        <div class="rounded-2xl bg-gray-50 p-6 h-fit">
            <h2 class="text-lg font-medium text-gray-900 mb-6">
                Order summary
            </h2>

            <dl class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <dt class="text-gray-600">Subtotal ({{ $cart->items_count }} items)</dt>
                    <dd class="font-medium text-gray-900">${{ number_format($total, 2, '.', '.') }}</dd>
                </div>

                <div class="flex justify-between">
                    <dt class="text-gray-600 flex items-center gap-1">
                        Shipping estimate
                    </dt>
                    <dd class="font-small text-gray-900">$0.00</dd>
                </div>

                <div class="flex justify-between">
                    <dt class="text-gray-600 flex items-center gap-1">
                        Tax estimate
                    </dt>
                    <dd class="font-small text-gray-900">$0.00</dd>
                </div>

                <div class="border-t pt-4 flex justify-between text-base font-semibold">
                    <dt class="text-gray-600 flex items-center gap-1">Order total</dt>
                    <dd class="font-small text-gray-900">${{ number_format($total, 2, '.', '.') }}</dd>
                </div>
            </dl>

            <button
                class="mt-6 w-full rounded-lg bg-indigo-600 py-3 text-white font-medium hover:bg-indigo-700 transition"
            >
                Checkout
            </button>
        </div>
    </div>
</div>
