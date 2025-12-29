@if(auth()->user()->is_admin)

<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>

@else

<x-layouts.app.market-sidebar :title="$title ?? 'market'">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.market-sidebar>

@endif
