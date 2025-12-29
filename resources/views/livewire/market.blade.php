<div class="bg-dark">
  <div class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @foreach ($products as $product)
            <div class="group relative">
                <img src="/products/{{ Str::lower(Str::kebab($product->name)) }}.jpg"
                    class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:h-80"
                />
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-400">
                            <span aria-hidden="true" class="absolute inset-0 pointer-events-none"></span>
                            Stock {{ $product->stock_quantity }} pcs
                        </h3>
                        <p class="mt-1 text-sm text-gray-300">{{ $product->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">${{ $product->price }}</p>
                        <button wire:click="addToCart({{ $product->id }})" type="button" class="mt-2 rounded-md bg-indigo-600 py-1 px-3 text-sm text-white cursor-pointer">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</div>
