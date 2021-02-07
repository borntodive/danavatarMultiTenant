@props(
    [
        'mobile'=>false
    ]
    )
<x-layout.menu-link :mobile="$mobile" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-layout.menu-link>
